<footer class=" navbar-dark bg-dark fixed-bottom text-center">
    <div class="container">
        <p>Developed by &copy;KelompokPBW2020</p>
    </div>
</footer>
 <!-- Offline jsbootstrap -->    
<script src="script/bootstrap.min.js" ></script>
<script src="script/bootstrap.bundle.min.js"></script>
<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
</script>