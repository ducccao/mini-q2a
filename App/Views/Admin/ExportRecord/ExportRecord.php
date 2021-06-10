<div class="row p-5">
    <div class="col-sm-12">
        <h5>Export record</h5>

        <button id="answers" class=" btn-call-api btn btn-primary">Answers</button>
        <button id="labels" class=" btn-call-api btn btn-primary">labels</button>
        <button id="questioncategories" class=" btn-call-api btn btn-primary">questioncategories</button>

        <button id="questionQueue" class=" btn-call-api btn btn-primary">questionqueue</button>
        <button id="questionQueueLabel" class=" btn-call-api btn btn-primary">quetionqueue_labels</button>
        <button id="rating-answers" class=" btn-call-api btn btn-primary">ratingsAnswer</button>

        <button id="rating-questions" class=" btn-call-api btn btn-primary">ratingsquestion</button>
        <button id="users" class=" btn-call-api btn btn-primary">users</button>

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

        document.execCommand("copy", true, content);
        txtRecords.text("");
        alert("Đã copy");
        return;
    })



    const btnCallAPIS = $(".btn-call-api");



    for (let i = 0; i < btnCallAPIS.length; ++i) {

        btnCallAPIS[i].addEventListener("click", e => {
            console.log(btnCallAPIS[i]);

            $.ajax({
                url: `http://localhost:3000/api/${btnCallAPIS[i].id}`,
                method: "get",
                success: ret => {

                    const data = JSON.stringify(ret.data);


                    txtRecords.text("");
                    txtRecords.text(data);
                },
                error: er => {

                }

            })

        })

        btnCallAPIS[i].onclick = e => {




        }

    }
</script>