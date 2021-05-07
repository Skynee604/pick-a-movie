<?php
?>
<footer class="footer mt-auto py-3">
    <div class="container" id="footer">
    </div>
</footer>
</body>

</html>

<script>
    $(document).ready(function() {

        var date = new Date().getFullYear();

        $("<span class = 'text' > ©"+date + " Pick a Movie | Tous Droits Réservés </span>").appendTo("#footer");
    });
</script>