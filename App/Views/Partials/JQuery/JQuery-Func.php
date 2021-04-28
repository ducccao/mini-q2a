<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script>
    $("#txtSearchBar").keypress((event)=>{
        const uri = window.location.href;
        if(event.which == 13){
            event.preventDefault();
            window.location.href = uri + `&keyWord=${event.target.value}`;
        }
    })
</script>