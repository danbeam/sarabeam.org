<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8;" />
	<title>sarabeam.org</title>
    <link rel="stylesheet" href="default.css" type="text/css" media="screen" />
</head>

<body>

<div id="header"></div>

<div id="gallery_frame">
    <a id="prev_arrow" href="#prev"></a>
    <div id="gallery_container">
        <div id="gallery_slider"><?php

$dir = opendir('./gallery/');

while ($file = readdir($dir)) {
    if ('.' !== $file && '..' !== $file) {
        echo '
            <div><img src="gallery/' . $file . '" width="625" /></div>';
    }
}

?>

        </div>
    </div>
    <a id="next_arrow" href="#next"></a>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script>

    // when the page is ready
    $(function () {

        // set the width of the slider to 100% x number of slider panels
        $('#gallery_slider').each(function () {
            $(this).css({'width': $(this).children().length * 100 + '%'});
        });

        // attach event handlers to prev / next
        $('#prev_arrow').click(function (e) {
            // if we're not at the first slot
            if (0 === $('#gallery_slider:animated').length && (parseInt($('#gallery_slider').css('left')) < 0)) {
                // animate the slider to the left
                $('#gallery_slider').animate(
                    {'left': '+=' + $('#gallery_container').outerWidth() + 'px'},
                    'slow',
                    'swing'
                );
            }
            // don't bubble the event
            e.preventDefault();
        });

        // attach event handlers to prev / next
        $('#next_arrow').click(function (e) {
            // if we're not at the first slot
            if (0 === $('#gallery_slider:animated').length && ($('#gallery_slider').outerWidth() > -parseInt($('#gallery_slider').css('left')) + $('#gallery_container').outerWidth())) {
                // animate the slider to the left
                $('#gallery_slider').animate(
                    {'left': '-=' + $('#gallery_container').outerWidth() + 'px'},
                    'slow',
                    'swing'
                );
            }
            // don't bubble the event
            e.preventDefault();
        });
    });

</script>

</body>

</html>
