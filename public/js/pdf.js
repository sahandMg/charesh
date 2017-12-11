PDFDocument = require('pdfkit');
var fs = require('fs');
var unique = require('uniq');
var blob = require('blob');
var blobStream  = require('blob-stream');
var br = require('browserify');
// # Create a document
// doc = new PDFDocument;
// stream = doc.pipe(blobStream());
// // # Pipe its output somewhere, like to a file or HTTP response
// // # See below for browser usage
// doc.pipe (fs.createWriteStream('output.pdf'));
//
// // # Embed a font, set the font size, and render some text
// doc.font('Times-Roman')
//     .fontSize(25)
//     .text('Some text with an embedded font!', 100, 100);
//
// // # Add another page
// doc.addPage()
//     .fontSize(25)
//     .text('Here is some vector graphics...', 100, 100);
//
// // # Draw a triangle
// doc.save()
//     .moveTo(100, 150)
//     .lineTo(100, 250)
//     .lineTo(200, 250)
//     .fill("#FF3300");
//
// // # Apply some transforms and render an SVG path with the 'even-odd' fill rule
// doc.scale(0.6)
//     .translate(470, -380)
//     .path('M 250,75 L 323,301 131,161 369,161 177,301 z')
//     .fill('red', 'even-odd')
//     .restore();
//
// // # Add some text with annotations
//     doc.addPage()
//         .fillColor("blue")
//         .text('Here is a link!', 100, 100)
//         .underline(100, 100, 160, 27)
//         .link(100, 100, 160, 27, 'http://google.com/');
//
//
// //    image
//
// doc.image('dota22.jpg', 0, 15, width=300)
// .text('Proportional to width', 0, 0);
//
// doc.addPage();
// // # Fit the image within the dimensions
// doc.image('dota22.jpg', 320, 15, fit= [100, 100])
// .rect(320, 15, 100, 100)
//     .stroke()
//     .text('Fit', 320, 0);
// doc.addPage();
// // # Stretch the image
// doc.image('dota22.jpg', 320, 145, width=200, height= 100)
// .text('Stretch', 320, 130);
//
// // # Scale the image
// doc.image('dota22.jpg', 320, 280, scale= 0.25)
// .text('Scale', 320, 265);
//
//
// // # Finalize PDF file
// doc.end();
//
// stream.on('finish', function() {
//     blob = stream.toBlob('application/pdf');
//     saveAs(blob, 'MyFile.pdf');
// });
// create a document and pipe to a blob
var doc = new PDFDocument();
var stream = doc.pipe(blobStream());

// draw some text
doc.fontSize(25)
    .text('Here is some vector graphics...', 100, 80);

// some vector graphics
doc.save()
    .moveTo(100, 150)
    .lineTo(100, 250)
    .lineTo(200, 250)
    .fill("#FF3300");

doc.circle(280, 200, 50)
    .fill("#6600FF");

// an SVG path
doc.scale(0.6)
    .translate(470, 130)
    .path('M 250,75 L 323,301 131,161 369,161 177,301 z')
    .fill('red', 'even-odd')
    .restore();

// and some justified text wrapped into columns
doc.text('And here is some wrapped text...', 100, 300)
    .font('Times-Roman', 13)
    .moveDown()
    .text('lorem', {
        width: 412,
        align: 'justify',
        indent: 30,
        columns: 2,
        height: 300,
        ellipsis: true
    });

// end and display the document in the iframe to the right
doc.end();



var saveData = (function () {
    var a = document.createElement("a");
    document.body.appendChild(a);
    a.style = "display: none";
    return function (blob, fileName) {
        var url = window.URL.createObjectURL(blob);
        a.href = url;
        a.download = fileName;
        a.click();
        window.URL.revokeObjectURL(url);
    };
}());



stream.on('finish', function() {

    var blob = stream.toBlob('application/pdf');
    saveData(blob, 'aa.pdf');

    // iframe.src = stream.toBlobURL('application/pdf');
});