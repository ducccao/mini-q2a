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
        cursor: pointer;
    }

    .tool-tip {
        position: absolute;
        padding: 6px 36px;
        top: 135%;
        left: 0%;
        display: none;
        color: black;
        background-color: #fff;
        border-radius: 5px;

    }

    .tool-tip::after {
        content: "";
        bottom: 100%;
        left: 50%;
        border-style: solid;
        position: absolute;
        border-width: 10px;
        border-color: #fff;
        border-color: transparent transparent #fff transparent;
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
    let dataColumnRemain = [];
    /**
     * FLOW:
     * + use an array to carry stuff
     * + remove remain when it was clicked and add it into added hold
     * + remove added when it was clicked and add it into remain hold
     * + update array carry stuff
     * 
     * 
     */


    // const btnPatch = $("#btnPatch");




    // handle btn table show data col when it was clicked
    for (let i = 0; i < btnTable.length; ++i) {
        btnTable[i].addEventListener("click", (e) => {
            loadInforColWhenClick(btnTable[i].id);
        });
    }

    function loadInforColWhenClick(tableName) {
        // col default
        $.ajax({
            url: `http://localhost:3000/api/${tableName}/column-default`,
            success: ret => {
                holdAdded.empty();
                for (let j = 0; j < ret.column_added.length; ++j) {

                    let tagAdded = ` <div class="default-tag">
                    ${ret.column_added[j]}
             
                    <div class="tool-tip">Trường default</div>
                </div>`;


                    holdAdded.append($("<div>").html(tagAdded).contents());


                }

            },
            error: er => {
                console.log(er);
            }
        })

        // add column name

        $.ajax({
            url: `http://localhost:3000/api/${tableName}/toggle-column-name`,
            success: ret => {
                dataColumnName = [];
                for (let k = 0; k < ret.toggle_column_name.length; ++k) {

                    let tagAdded2 = ` <div class="tag">
                    ${ret.toggle_column_name[k]}
             
                    <i class="fas fa-times"></i>
                </div>`;


                    dataColumnName.push(ret.toggle_column_name[k]);
                    holdAdded.append($("<div>").html(tagAdded2).contents());
                }

                const tag = $(".tag");
                for (let j = 0; j < tag.length; ++j) {
                    tag[j].onclick = e => {
                        tag[j].style.display = 'none';

                        const tagAdd1 = `
                           <div class="tag-add col-name">
                    ${tag[j].textContent.trim()}
                    <i class="fas fa-plus"></i>
                </div>                    
                            `;


                        holdAdd.append($("<div>").html(tagAdd1).contents());

                    }
                }


                const colName = $(".col-name");
                handleColNameClick(colName);


            },
            error: er => {

            }
        })


        // add column remain

        $.ajax({
            url: `http://localhost:3000/api/${tableName}/column-remain`,
            success: ret => {

                holdAdd.empty();
                dataColumnRemain = [];

                for (let z = 0; z < ret.column_remain.length; ++z) {
                    let tag_need_to_add = `
                        <div class="tag-add col-remain">
                    ${ret.column_remain[z]}
                    <i class="fas fa-plus"></i>
                </div>
                        `;


                    dataColumnRemain.push(ret.column_remain[z]);
                    holdAdd.append($("<div>").html(tag_need_to_add).contents());

                }

                const colRemain = $(".col-remain");
                handleColRemainClick(colRemain);
                const colName = getColName();
                handleColNameClick(colName);


                console.log(colName)



            },
            error: er => {
                console.log(er);

            }
        })


    }


    // delete element in a array
    function deleteEleInArray(a, pos) {
        let ret = [...a];
        for (let i = pos; i < ret.length; ++i) {
            ret[i] = ret[i + 1];
        }
        ret.length--;
        return ret;
    }


    function handleColNameClick(colName) {
        for (let i = 0; i < colName.length; ++i) {
            colName.onclick = e => {
                colName[i].style.display = "none";
                let colRemainIndex = document.createElement("div");
                colRemainIndex.classList.add("tag-add");
                colRemainIndex.classList.add("col-remain");

                let plusElement = document.createElement("i");
                plusElement.classList.add("fas");
                plusElement.classList.add("fa-plus");

                colRemainIndex.append(plusElement);

                holdAdd.append(colRemainIndex);
            }
        }
    }

    function handleColRemainClick(colRemain) {

        for (let i = 0; i < colRemain.length; ++i) {
            colRemain[i].onclick = e => {
                colRemain[i].style.display = "none";


                let colNameIndex = document.createElement("div");
                colNameIndex.classList.add("tag");
                colNameIndex.classList.add("col-name");

                let deleteElement = document.createElement("i");
                deleteElement.classList.add("fas");
                deleteElement.classList.add("fa-times");
                deleteElement.classList.add("ml-1");


                // <i class="fas fa-plus"></i>

                colNameIndex.textContent = colRemain[i].textContent.trim();
                colNameIndex.append(deleteElement);


                colNameIndex.addEventListener("click", () => {

                    colNameIndex.style.display = "none";


                    let colRemainIndex = document.createElement("div");
                    colRemainIndex.classList.add("tag-add");
                    colRemainIndex.classList.add("col-remain");

                    let plusElement = document.createElement("i");
                    plusElement.classList.add("fas");
                    plusElement.classList.add("fa-plus");

                    colRemainIndex.textContent = colNameIndex.textContent.trim();
                    colRemainIndex.append(plusElement);

                    holdAdd.append(colRemainIndex);
                })

                holdAdded.append(colNameIndex);

                const colName = $(".col-name");
                handleColNameClick(colName);
            }
        }

        console.log(holdAdded[0]);

        for (let i = 0; i < holdAdded[0].length; ++i) {
            console.log(holdAdded[0][i]);

        }
    }

    function getColName() {
        const ret = $(".col-name");
        return ret;
    }

    function getColRemain() {
        const ret = $(".col-remain");
        return ret;
    }

    function loadUserFirstTime() {
        // col default
        $.ajax({
            url: `http://localhost:3000/api/users/column-default`,
            success: ret => {
                holdAdded.empty();
                for (let j = 0; j < ret.column_added.length; ++j) {

                    let tagAdded = ` <div class="default-tag">
                    ${ret.column_added[j]}
             
                    <div class="tool-tip">Trường default</div>
                </div>`;


                    holdAdded.append($("<div>").html(tagAdded).contents());


                }

            },
            error: er => {
                console.log(er);
            }
        })

        // add column name

        $.ajax({
            url: `http://localhost:3000/api/users/toggle-column-name`,
            success: ret => {
                dataColumnName = [];
                for (let k = 0; k < ret.toggle_column_name.length; ++k) {

                    let tagAdded2 = ` <div class="tag">
                    ${ret.toggle_column_name[k]}
             
                    <i class="fas fa-times"></i>
                </div>`;


                    dataColumnName.push(ret.toggle_column_name[k]);
                    holdAdded.append($("<div>").html(tagAdded2).contents());
                }

                const tag = $(".tag");
                for (let j = 0; j < tag.length; ++j) {
                    tag[j].onclick = e => {
                        tag[j].style.display = 'none';

                        const tagAdd1 = `
                           <div class="tag-add col-name">
                    ${tag[j].textContent.trim()}
                    <i class="fas fa-plus"></i>
                </div>                    
                            `;


                        holdAdd.append($("<div>").html(tagAdd1).contents());

                    }
                }


                const colName = $(".col-name");
                handleColNameClick(colName);


            },
            error: er => {

            }
        })


        // add column remain

        $.ajax({
            url: `http://localhost:3000/api/users/column-remain`,
            success: ret => {

                holdAdd.empty();
                dataColumnRemain = [];

                for (let z = 0; z < ret.column_remain.length; ++z) {
                    let tag_need_to_add = `
                        <div class="tag-add col-remain">
                    ${ret.column_remain[z]}
                    <i class="fas fa-plus"></i>
                </div>
                        `;


                    dataColumnRemain.push(ret.column_remain[z]);
                    holdAdd.append($("<div>").html(tag_need_to_add).contents());

                }

                const colRemain = $(".col-remain");
                handleColRemainClick(colRemain);
                const colName = getColName();
                handleColNameClick(colName);


                console.log(colName)



            },
            error: er => {
                console.log(er);

            }
        })




    }

    loadUserFirstTime();
</script>