<html>
<head>
    <title>Reset Rak Casting Pasting</title>
</head>
<body>
    <h1>Auto Reset Rak Casting To Pasting</h1>
    <script>
        $(document).ready(function(){
            setTimeout(function(){ reload_page(); },60*60000);
        });

        function reload_page()
        {
            window.location.reload(true);
        }
    </script>

</body>
</html>