
<button onclick="fun()" >test</button>

<script>
    function fun(){
        console.log("test");    
        var xhr= new XMLHttpRequest();
        xhr.open("POST","http://localhost/GuestPro/Receptionists/test",true);

        xhr.onreadystatechange=function(){

            if(xhr.readyState==XMLHttpRequest.DONE){

                if(xhr.status==200){
                    console.log(xhr.responseText);
                }

            }
        }
        xhr.send();
    }
</script> 