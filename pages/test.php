<!doctype html>
<html>

<head>
    <title>Character limit in a Textarea element with a Counter</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

    <style>
    * {
        font: 17px Calibri;
    }

    textarea {
        padding: 10px 5px;
    }
    </style>
</head>

<body>
    <div>
        <p>
            <textarea id="myTextarea" cols="50" placeholder="Enter some value (Max. 20 chars. limit)"></textarea>
        </p>
        <p id="textCounter">20 Characters limit</p>
    </div>
</body>

<script>
$(document).ready(function() {
    $('#myTextarea').on('input propertychange', function() {
        charLimit(this, 20);
    });
});

function charLimit(input, maxChar) {
    var len = $(input).val().length;
    $('#textCounter').text(maxChar - len + ' characters remaining');

    if (len > maxChar) {
        $(input).val($(input).val().substring(0, maxChar));
        $('#textCounter').text(0 + ' characters remaining');
    }
}
</script>

</html>