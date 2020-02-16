$(function () {
    $('form').on('submit', function (e) {
        e.preventDefault
        $.ajax({
            type: 'post',
            url: 'lib/src/server_submit.php',
            data: $('form').serialize(),
            success: function () {
		        document.getElementById('jerry').value="";
            }
        });
    });
    document.getElementById('jerry').value="";
 });
