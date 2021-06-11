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

                <div id="users" href="/mini-q2a/admin?action=config-api&table=users" name="table" value="users" class="btn btn-primary btn-table">Bảng Users</div>
                <div id="answers" href="/mini-q2a/admin?action=config-api&table=answers" name="table" value="answers" class="btn btn-primary btn-table">Bảng Answers</div>
                <div id="questionqueue" href="/mini-q2a/admin?action=config-api&table=questionqueue" name="table" value="questionqueue" class="btn btn-primary btn-table">Bảng Question Queue</div>

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

            <button class="btn btn-success" id="btnPatch">
                Cập nhật
            </button>

        </div>
    </div>
</div>



<script>
    const btnTable = $(".btn-table");
    const holdAdded = $("#hold-added");
    const holdAdd = $("#hold-add");
    let currTable = "";
    let dataColumnName = [];
    /**
     * FLOW:
     * + use an array to carry stuff
     * + remove remain when it was clicked and add it into added hold
     * + remove added when it was clicked and add it into remain hold
     * + update array carry stuff
     * 
     * 
     */


    for (let i = 0; i < btnTable.length; ++i) {
        btnTable[i].onclick = e => {
            currTable = btnTable[i].id;
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


            // add column name
            $.ajax({
                url: `http://localhost:3000/api/${btnTable[i].id}/toggle-column-name`,
                success: ret => {
                    for (let k = 0; k < ret.toggle_column_name.length; ++k) {

                        let tagAdded2 = ` <div class="tag">
                    ${ret.toggle_column_name[k]}
             
                    <i class="fas fa-times"></i>
                </div>`;


                        holdAdded.append($("<div>").html(tagAdded2).contents());
                    }

                    const tag = $(".tag");
                    for (let j = 0; j < tag.length; ++j) {
                        tag[j].onclick = e => {
                            tag[j].style.display = 'none';

                            const tagAdd1 = `
                           <div class="tag-add ">
                    ${tag[j].textContent.trim()}
                    <i class="fas fa-plus"></i>
                </div> 

                            
                            `;


                            holdAdd.append($("<div>").html(tagAdd1).contents());

                        }
                    }
                },
                error: er => {

                }
            })

            // add column remain

            $.ajax({
                url: `http://localhost:3000/api/${btnTable[i].id}/column-remain`,
                success: ret => {

                    holdAdd.empty();
                    for (let z = 0; z < ret.column_remain.length; ++z) {
                        let tag_need_to_add = `
                        <div class="tag-add ">
                    ${ret.column_remain[z]}
                    <i class="fas fa-plus"></i>
                </div>
                        `;


                        holdAdd.append($("<div>").html(tag_need_to_add).contents());



                        const tagAdd = $(".tag-add");


                        for (let j = 0; j < tagAdd.length; ++j) {

                            if (tagAdd[j].textContent.trim() === "") {
                                tagAdd[j].style.display = "none";
                            }

                            dataColumnName = [];
                            tagAdd[j].onclick = e => {
                                tagAdd[j].style.display = "none";
                                // patch it
                                dataColumnName.push(tagAdd[j].textContent.trim());

                                let tagAdded3 = ` <div class="tag">
                    ${tagAdd[j].textContent.trim()}
             
                    <i class="fas fa-times"></i>
                </div>`;
                                holdAdded.append($("<div>").html(tagAdded3).contents());




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


    const btnPatch = $("#btnPatch");



    btnPatch.on("click", e => {
        const dataClient = {
            column_name: dataColumnName,
            table_name: currTable
        }


        console.log(dataClient);



        $.ajax({
            url: `http://localhost:3000/api/${currTable}/column-name`,
            contentType: "application/json",
            method: "patch",
            data: JSON.stringify(dataClient),
            success: ret => {
                // get data again
                // btnTable[`${currTable}`].click();


                for (let i = 0; i < btnTable.length; ++i) {
                    if (btnTable[i].id.toString().toUpperCase() === currTable.toUpperCase()) {
                        btnTable[i].click();
                        break;
                    }
                }

            },
            error: er => {
                // get data again
                for (let i = 0; i < btnTable.length; ++i) {
                    if (btnTable[i].id === currTable) {
                        btnTable[i].click();
                    }
                }
            }
        })

    })
</script>