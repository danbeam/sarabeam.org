<?php

$dir = opendir('./gallery/');
$files = array();

while ($file = readdir($dir)) {
    if (preg_match('/png|gif|jpe?g/i', $file)) {
        $files[] = $file;
    }
}

natcasesort($files);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
        <div id="gallery_slider"></div>
    </div>
    <a id="next_arrow" href="#next"></a>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script>

    // when the page is ready
    $(function () {

        var header  = '<div><img src="gallery/',
            trailer = '" width="625" /></div>',
            files   = [
                '<?php echo implode($files,"',\n\t\t'"); ?>'
            ];

        // add the images to the gallery
        $('#gallery_slider').append(header + files.join(trailer + header) + trailer);

        // set the width of the slider to 100% x number of slider panels
        $('#gallery_slider').each(function () {
            $(this).css({'width': $(this).children().length * 100 + '%'});
        });

        // attach event handlers to prev / next
        $('#prev_arrow').click(function (e) {
            // do some DOM queries and calculate some stuff
            var $slider    = $('#gallery_slider'),
                $frame     = $('#gallery_frame'),
                $container = $('#gallery_container'),
                offset     = parseInt($slider.css('left')),
                current    = -offset/$container.outerWidth();

            // if we're not at the first slot
            if (!$slider.is(':animated') && offset < 0) {
                // animate the height of the slider frame
                $frame.animate(
                    {'height': $slider.find('img:eq(' + (current-1) + ')').height()},
                    1000,
                    'swing'
                );
                // animate the slider to the left
                $slider.animate(
                    {'left': '+=' + $('#gallery_container').outerWidth() + 'px'},
                    1000,
                    'swing'
                );
            }
            // don't bubble the event
            e.preventDefault();
        });

        // attach event handlers to prev / next
        $('#next_arrow').click(function (e) {
            // do some DOM queries and calculate some stuff
            var $slider    = $('#gallery_slider'),
                $frame     = $('#gallery_frame'),
                $container = $('#gallery_container'),
                offset     = parseInt($slider.css('left')),
                current    = -offset/$container.outerWidth();

            // if we're not at the first slot
            if (!$slider.is(':animated') && ($slider.outerWidth() > -offset + $container.outerWidth())) {
                // animate the height of the slider frame
                $frame.animate(
                    {'height': $slider.find('img:eq(' + (current+1) + ')').height()},
                    1000,
                    'swing'
                );
                // animate the slider to the left
                $slider.animate(
                    {'left': '-=' + $container.outerWidth() + 'px'},
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
