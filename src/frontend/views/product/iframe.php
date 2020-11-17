<?php

?>

<iframe onload="resizeIframe(this)" src="<?=$url?>" frameborder="0" scrolling="no">
</iframe>

<script>
    function resizeIframe(obj) {
        obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
    }
</script>
