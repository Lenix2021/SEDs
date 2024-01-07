function printFormContent() {
    // Create a new iframe
    var printFrame = document.createElement('iframe');
    printFrame.style.display = 'none';
    document.body.appendChild(printFrame);

    printFrame.contentDocument.write(`<html><head><title>Print Form Content</title></head><body>`);
        printFrame.contentDocument.write('<div class="printable-content">');
        printFrame.contentDocument.write(document.getElementById('form').innerHTML);
        printFrame.contentDocument.write('</div></body></html>');
        printFrame.contentDocument.close();
}