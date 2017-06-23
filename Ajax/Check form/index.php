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
            
            $("#done").bind("click", function(){
                var admin = "Admin";
                $.ajax({
                    url: "check.php",
                    type: "POST",
                    data: ({name: $("#name").val()}),
                    dataType: "html",
                    beforeSend: function(){
                        $("#information").text("Очікування даних...");
                    },
                    success: function(data){
                        if(data == "Fail")
                            alert("Ім'я зайняте");
                        else
                            $("#information").text(data);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <input type="text" id="name" placeholder="Введіть ім'я" />
    <input type="button" id="done" value="Готово" />
	<p id="load" style="cursor: pointer">Загрузка даних</p>
    <div id="information"></div>
</body>
</html>