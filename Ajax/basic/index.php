<!DOCTYPE html>
<head>
	<title>Test</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        function funcBefore(){
            $("#information").text("Очікування даних...");
        }
        function funcSuccess(data){
            $("#information").text(data);
        }
        
        $(document).ready(function(){
            $("#load").bind("click", function(){
                var admin = "Admin";
                $.ajax({
                    url: "content.php",
                    type: "POST",
                    data: ({name: admin, number: 5}),
                    dataType: "html",
                    beforeSend: funcBefore,
                    success: funcSuccess
                });
            });
        });
    </script>
</head>
<body>
	<p id="load" style="cursor: pointer">Загрузка даних</p>
    <div id="information"></div>
</body>
</html>