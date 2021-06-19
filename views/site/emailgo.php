<h1 style="background-color: azure;">Отправил на: <div id="response" style="background-color: azure; margin-top: 50px; "></div></h1>
<h1 style="background-color: azure;">Осталось отправить: <div id="countemail" style="background-color: azure; margin-top: 50px; "></div></h1>

<script>
    function emailgo() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/api/emailgo', true);
        xhr.onload = function () {
            document.getElementById("response").innerHTML = this.responseText;
            console.log(this.responseText);
        }
        xhr.send(null);
    };
    setInterval(emailgo, 3000);

    function countemail() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/api/countemail', true);
        xhr.onload = function () {
            document.getElementById("countemail").innerHTML = this.responseText;
            console.log(this.responseText);
        }
        xhr.send(null);
    };
    setInterval(countemail, 1000);
</script>
