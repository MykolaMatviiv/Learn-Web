<!DOCTYPE html>
<head>
	<title>Test</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        function funcBefore(){
            $("#information").text("���������� �����...");
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
                        $("#information").text("���������� �����...");
                    },
                    success: function(data){
                        if(data == "Fail")
                            alert("��'� �������");
                        else
                            $("#information").text(data);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <input type="text" id="name" placeholder="������ ��'�" />
    <input type="button" id="done" value="������" />
	<p id="load" style="cursor: pointer">�������� �����</p>
    <div id="information"></div>
</body>
</html>