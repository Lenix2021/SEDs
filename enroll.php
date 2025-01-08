<?php
session_start(); // Start the session

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fname'])) {
  // Collect form data
  $formData = [
    'First Name' => htmlspecialchars(trim($_POST['fname'] ?? '')),
    'Middle Name' => htmlspecialchars(trim($_POST['mname'] ?? '')),
    'Last Name' => htmlspecialchars(trim($_POST['lname'] ?? '')),
    'Date of Birth' => htmlspecialchars(trim($_POST['DOB'] ?? '')),
    'Home Address' => htmlspecialchars(trim($_POST['homeadd'] ?? '')),
    'Last School Attended' => htmlspecialchars(trim($_POST['lastSchoolAttended'] ?? '')),
    'Certification Awarded' => htmlspecialchars(trim($_POST['certification_awarded'] ?? '')),
    'Company Name' => htmlspecialchars(trim($_POST['cname'] ?? '')),
    'Years of Experience' => htmlspecialchars(trim($_POST['years'] ?? '')),
    'Bio' => htmlspecialchars(trim($_POST['bio'] ?? '')),
    'Parent/Sponsor Name' => htmlspecialchars(trim($_POST['pname'] ?? '')),
    'Contacts' => htmlspecialchars(trim($_POST['contacts'] ?? '')),
    'How Did You Hear About Us?' => htmlspecialchars(trim($_POST['namep'] ?? '')),
    // 'Signature' => htmlspecialchars(trim($_POST['sign'] ?? ''))
  ];

  // Default response
  $emailSent = false;
  $message = 'Failed to submit enrollment details. Please try again.';

  // Attempt to send the email
  if (sendEnrollmentDetails('tsiseds@outlook.com', $formData)) {
    $emailSent = true;
    $message = 'Enrollment details submitted successfully for ' . $formData['First Name'] . '.';
  }

  // Store message and status in session
  $_SESSION['message'] = $message;
  $_SESSION['emailSent'] = $emailSent;

  // Redirect to prevent form resubmission
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit();
}

// Retrieve and clear session message
$message = $_SESSION['message'] ?? null;
$emailSent = $_SESSION['emailSent'] ?? null;
unset($_SESSION['message'], $_SESSION['emailSent']);

function sendEnrollmentDetails($email, $formData)
{
  $apiKey = "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";

  $htmlContent = "<html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; }
            table { width: 100%; border-collapse: collapse; }
            th, td { padding: 10px; text-align: left; border: 1px solid #ddd; }
            th { background-color: #f4f4f4; }
        </style>
    </head>
    <body>
        <h1>New Enrollment Form Submission</h1>
        <table>
            <thead>
                <tr><th>Field</th><th>Value</th></tr>
            </thead>
            <tbody>";

  foreach ($formData as $field => $value) {
    $htmlContent .= "<tr><td>$field</td><td>$value</td></tr>";
  }

  $htmlContent .= "</tbody>
        </table>
    </body>
    </html>";

  $data = [
    "subject" => "New Enrollment Form Submission",
    "htmlContent" => $htmlContent,
    "sender" => ["name" => "Enrollment Team", "email" => "rickpiero237@gmail.com"],
    "to" => [["email" => $email]]
  ];

  $ch = curl_init("https://api.brevo.com/v3/smtp/email");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "api-key: $apiKey",
    "Content-Type: application/json"
  ]);

  $response = curl_exec($ch);
  $success = !curl_errno($ch) && curl_getinfo($ch, CURLINFO_HTTP_CODE) == 201;

  curl_close($ch);

  return $success;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Enrollment Form</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="shortcut icon" href="../img/sedslogo.png" type="image/x-icon" />
  <link rel="stylesheet" href="./css/styles.css" />
  <link rel="stylesheet" href="./css/enroll.css" />
  <script>
    window.onload = function () {
      const emailSent = <?php echo json_encode($emailSent); ?>;
      const message = <?php echo json_encode($message); ?>;

      if (emailSent !== null) {
        const formSection = document.getElementById('form');
        if (emailSent) {
          formSection.innerHTML = `<div class="success-message">${message}</div>`;
        } else {
          formSection.innerHTML = `<div class="error-message">${message}</div>`;
        }
      }
    };
  </script>
  <style>
    .success-message {
      color: green;
      font-weight: bold;
    }

    .error-message {
      color: red;
      font-weight: bold;
    }
  </style>
</head>

<body class="enrollment-body">
  <nav>
    <div class="container-fluid">
      <div class="logo-seds">
        <img src="./img/logoforseds.png" alt="" srcset="" />
      </div>

      <div class="head">
        <h1>The SEDS Institute</h1>
      </div>

      <ul class="navs">
        <li><a href="./index.html">HOME</a></li>
        <li><a href="./aboutus.html">ABOUT</a></li>
        <li><a href="./courses.html">COURSES</a></li>
        <li><a href="./gallery2.html">GALLERY</a></li>
        <li><a href="./contactus.html">CONTACT</a></li>
      </ul>

      <div id="menu-icon" class="bx bx-menu"></div>
    </div>
  </nav>

  <div id="menu-sidebar">
    <div class="close-button" id="close-menu">
      <i class="bx bx-x"></i>
    </div>
    <div class="menu-items">
      <div class="back">
        <a href="./index.html">HOME</a>
      </div>
      <div class="back">
        <a href="./aboutus.html">ABOUT</a>
      </div>
      <div class="back">
        <a href="./courses.html">COURSES</a>
      </div>
      <div class="back">
        <a href="./contactus.html">CONTACT</a>
      </div>
      <div class="back">
        <a href="./gallery2.html">GALLERY</a>
      </div>
    </div>
  </div>

  <section id="enrollment-form" class="section">
    <div class="container-fluid d-flex justify-center align-start">
      <div class="container">
        <div class="info">
          <h1>The SEDS Institute Form</h1>
        </div>

        <div class="enroll-form">
          <form action="enroll.php" method="post" id="form">
            <div class="block">
              <h1>Personal Info</h1>

              <div class="control align-center">
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" required class="input-control" />
              </div>

              <div class="control align-center">
                <label for="mname">Middle Name:</label>
                <input type="text" id="mname" name="mname" required class="input-control" />
              </div>

              <div class="control align-center">
                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" required class="input-control" />
              </div>

              <div class="control align-center">
                <label for="DOB">Date of Birth:</label>
                <input type="date" max="" id="DOB" name="DOB" required class="input-control" />
              </div>

              <div class="control">
                <label for="homeadd">Home Address:</label>
                <textarea name="homeadd" id="homeadd" rows="3" class="input-control"></textarea>
              </div>
            </div>

            <div class="block">
              <h1>Education</h1>

              <div class="control align-center">
                <label for="lastSchoolAttended">Last School Attended:</label>
                <input type="text" id="lastSchoolAttended" name="lastSchoolAttended" required class="input-control" />
              </div>

              <br />
              <h5>Certification Awarded</h5>
              <br />

              <div class="control inline">
                <input type="radio" id="bece" name="certification_awarded" required value="BECE" />
                <label for="bece">BECE</label>
              </div>

              <div class="control inline">
                <input type="radio" id="wascce" name="certification_awarded" required value="WASSCE" />
                <label for="wascce">WASSCE</label>
              </div>
              <div class="control inline">
                <input type="radio" id="high_school_diploma" name="certification_awarded" value="High School Diploma" />
                <label for="high_school_diploma">High School Diploma</label>
              </div>
              <div class="control inline">
                <input type="radio" id="degree" name="certification_awarded" value="Degree" />
                <label for="degree">Degree</label>
              </div>
              <div class="control inline">
                <input type="radio" id="hnd" name="certification_awarded" value="HND" />
                <label for="hnd">HND</label>
              </div>
              <div class="control inline">
                <input type="radio" id="masters" name="certification_awarded" value="Masters" />
                <label for="masters">Masters</label>
              </div>
            </div>

            <div class="block">
              <h1>Work Experiance</h1>
              <span id="span">NOTE: This section is optional</span>

              <div class="control align-center">
                <label for="cname">Company Name:</label>
                <input type="text" id="cname" name="cname" class="input-control" />
              </div>

              <div class="control align-center">
                <label for="years">Years:</label>
                <input type="number" id="years" name="years" class="input-control" />
              </div>

              <div class="control">
                <label for="bio">BIO:</label>
                <textarea name="bio" id="bio" cols="35" rows="3" class="input-control"></textarea>
              </div>
            </div>

            <div class="block">
              <h1>Parent/Sponsor</h1>

              <div class="control align-center">
                <label for="pname">Name</label>
                <input type="text" id="pname" name="pname" required class="input-control" />
              </div>

              <div class="control align-center">
                <label for="contacts">Contacts</label>
                <input type="text" id="contacts" name="contacts" required class="input-control" />
              </div>
            </div>

            <div class="block">
              <h1>Misc</h1>
              <div class="control">
                <label for="namep">How did you hear about us?</label>
                <input type="text" id="namep" name="namep" required class="input-control" />
              </div>

              <!-- <br /><br />
              <div class="block">
                <label for="sign">Signature</label>
                <input type="text" id="sign" name="sign" placeholder="---------------------------" />
              </div> -->

              <div class="form-button">
                <button class="button" type="submit">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <h4>copyright&copy;2025</h4>
  </footer>

  <script src="./js/script.js"></script>
  <!-- <script src="./js/enroll.js"></script> -->
  <script>

    const today = new Date();
    const pastDate = new Date(today.getFullYear() - 8, today.getMonth(), today.getDate());
    const formattedPastDate = pastDate.toISOString().split('T')[0];
    document.getElementById('DOB').setAttribute('max', formattedPastDate);
  </script>
</body>

</html>