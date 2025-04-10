<!-- Preloader -->
<div id="preloader">
    <img src="box.gif" alt="Loading..." />
</div>

<script>
    window.onload = function () {
        document.getElementById("preloader").style.display = "none";
        var main = document.getElementById("main-content");
        if (main) main.style.display = "block";
    };
</script>

<style>
#preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}
</style>
