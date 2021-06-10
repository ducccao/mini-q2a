<style>
    .hole {
        background-color: #b9e5ec;
        min-height: 120px;
        border-radius: 5px;
        display: flex;
        justify-content: flex-start;
    }

    .default-tag {
        border-radius: 5px;
        position: relative;
        background-color: gray;
        color: white;
        height: 30px;
        width: fit-content;
        margin: 0 10px;
        padding: 0 10px;

    }

    .tool-tip {
        position: absolute;
        width: 200px;
        bottom: -70%;
        left: 0%;
        display: none;
        color: black;
    }

    .default-tag:hover .tool-tip {
        display: initial;
    }

    .tag {
        border-radius: 5px;

        background-color: #ec959d;
        color: white;
        height: 30px;
        width: fit-content;
        margin: 0 10px;
        padding: 0 10px;

    }

    .tag:hover {
        cursor: pointer;
    }

    .tag-add {
        border-radius: 5px;

        background-color: lightgreen;
        color: black;
        height: 30px;
        width: fit-content;
        margin: 0 10px;
        padding: 0 10px;
    }

    .tag-add:hover {
        cursor: pointer;
    }
</style>

<div class="p-5">
    <div class="row">
        <div class="col-12">
            <h5 class="text-title ">Cấu hình API</h5>
            <div class="my-4">

                <div id="users" class="btn btn-primary btn-table">Bảng Users</div>
                <div id="answers" class="btn btn-primary btn-table">Bảng Answers</div>
                <div id="questionqueue" class="btn btn-primary btn-table">Bảng Question Queue</div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h5 class="text-title ">Các trường cần thiết để thêm dữ liệu vào bảng</h5>
            <div class="my-4  hole  p-3" id="hold-added">
                <!-- <div class="tag">
                    a
                    <i class="fas fa-times"></i>
                </div> -->

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h5 class="text-title ">Các trường còn lại</h5>
            <div class="my-4  hole p-3" id="hold-add">
                <!-- <div class="tag-add ">
                    a
                    <i class="fas fa-plus"></i>
                </div> -->

            </div>

        </div>
    </div>
</div>



<script>
    const btnTable = $(".btn-table");
    const holdAdded = $("#hold-added");
    const holdAdd = $("#hold-add");

    for (let i = 0; i < btnTable.length; ++i) {
        btnTable[i].onclick = e => {
            // add column default
            $.ajax({
                url: `http://localhost:3000/api/${btnTable[i].id}/column-default`,
                success: ret => {
                    holdAdded.empty();
                    for (let j = 0; j < ret.column_added.length; ++j) {

                        let tagAdded = ` <div class="default-tag">
                    ${ret.column_added[j]}
             
                    <div class="tool-tip">Trường default</div>
                </div>`;


                        holdAdded.append($("<div/>").html(tagAdded).contents());


                    }

                },
                error: er => {
                    console.log(er);
                }
            })

            // add column remain

            $.ajax({
                url: `http://localhost:3000/api/${btnTable[i].id}/column-remain`,
                success: ret => {

                    holdAdd.empty();
                    for (let i = 0; i < ret.column_remain.length; ++i) {
                        let tag_need_to_add = `
                        <div class="tag-add ">
                    ${ret.column_remain[i]}
                    <i class="fas fa-plus"></i>
                </div>
                        `;


                        holdAdd.append($("<div>").html(tag_need_to_add).contents());



                        const tagAdd = $(".tag-add");
                        // console.log(tagAdd);

                        for (let j = 0; j < tagAdd.length; ++j) {
                            tagAdd[j].onclick = e => {
                                tagAdd[j].style.display = "none";

                            }
                        }

                    }
                },
                error: er => {
                    console.log(er);

                }
            })




        }
    }
</script>