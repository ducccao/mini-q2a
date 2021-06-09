<div class="row p-5">
    <div class="col-sm-12">
        <h5>Export record</h5>

        <button id="btnAnswer" class=" btn-call-api btn btn-primary">Answers</button>
        <button id="btnLabels" class=" btn-call-api btn btn-primary">labels</button>
        <button id="btnQuestioncategories" class=" btn-call-api btn btn-primary">questioncategories</button>

        <button id="btnQuestionqueue" class=" btn-call-api btn btn-primary">questionqueue</button>
        <button id="btnQuetionqueue_labels" class=" btn-call-api btn btn-primary">quetionqueue_labels</button>
        <button id="btnRatingsAnswer" class=" btn-call-api btn btn-primary">ratingsAnswer</button>

        <button id="btnRatingsquestion" class=" btn-call-api btn btn-primary">ratingsquestion</button>
        <button id="btnUsers" class=" btn-call-api btn btn-primary">users</button>

    </div>


</div>
<div class="row p-5">
    <div class="col-sm-12">
        <div class="form-group">
            <textarea name="txtRecords" id="txtRecords" cols="1" rows="5" class="form-control">

           </textarea>
            <button id="btnCopy" class="btn btn-danger my-3">copy</button>
        </div>
    </div>
</div>


<?php


echo "<script>

const 

</script>"

?>

<script>
    const txtRecords = $("#txtRecords");



    const btnCopy = document.getElementById("btnCopy");

    btnCopy.addEventListener("click", e => {
        const content = txtRecords.select();

        document.execCommand("copy", false, content);
        alert(content.val())
        return;
    })




    const btnAnswer = $("#btnAnswer");
    const btnLabels = $("#btnLabels");
    const btnQuestioncategories = $("#btnQuestioncategories");
    const btnQuestionqueue = $("#btnQuestionqueue");
    const btnQuetionqueue_labels = $("#btnqQuetionqueue_labels");
    const btnRatingsAnswer = $("#btnRatingsAnswer");
    const btnRatingsquestion = $("#btnRatingsquestion");
    const btnUsers = $("#btnUsers");





    const btnCallAPIS = $(".btn-call-api");

    for (let i = 0; i < btnCallAPIS.length; ++i) {
        console.log(btnCallAPIS[i]);

        btnCallAPIS[i].onclick = e => {

            txtRecords.text("");
            txtRecords.text(i);
            alert(i);

        }

    }
</script>