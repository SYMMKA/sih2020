$(document).ready(function () {
    $("#recommendations").load(function () {
        $.ajax({
            type: "POST",
            url: "recommend/getBooks.php",
            data: FormData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data) {
                    data = JSON.parse(data);
                    html = ``;
                    data.forEach(function (branch, index) {
                        html +=
                            ` <h2>` +
                            branch +
                            `<h2>
                    <div class="d-flex flex-row flex-nowrap overflow-auto p-4">`;
                        branch.forEach(function (sem, index) {
                            html +=
                                `<div class="card">
                            <div
                                class="d-flex justify-content-center align-items-center card-body btn"
                                data-toggle="modal"
                                data-target="#modelId"
                                href
                            >
                                <h1 class="card-title">` +
                                sem +
                                `</h1>
                            </div>
                        </div>`;
                        });
                        html += `</div>
                </div>`;
                    });
                }
            },
        });
    });

    $("#showBooks").click(function () {
        $("#modalBodyContent").load(function () {
            $.ajax({
                type: "POST",
                url: "recommend/getBooks.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data) {
                        data = JSON.parse(data);
                        html = `<div class="row">
                            <div class="col-md-8 col-lg-10">
                                <div
                                    class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4"
                                    style="height: 500px; overflow-y: scroll;"
                                >`;
                        data.forEach(function (item, index) {
                            html +=
                                `
                        <div class="col mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="` +
                                item.imgLink +
                                `"
                            alt="Card image cap" style="height:20vw;" />
                            <div class="card-body" style="padding: 1rem;">
							<h4 class="card-title text-center">` +
                                item.title +
                                `</h4>
                            <p class="card-text">                   
                            <div class="row no-gutters">
                                <div Class="col-4">
                                <strong>Copy No:</strong>
                                </div>
                                <div Class="col-8">
                            ` +
                                item.copyno +
                                `
                                </div>
                            </div>

                            <div class="row no-gutters">
                                <div Class="col-4">
                                <strong>Copy ID: </strong>
                                </div>
                                <div Class="col-8">
                            ` +
                                item.copyID +
                                `
                                </div></br>
                            </div>

                            <div class="row no-gutters">
                                <div Class="col-4">
                                <strong>ISBN: </strong>
                                </div>
                                <div Class="col-8">
                            ` +
                                item.isbn +
                                `
                                </div></br>
                            </div>

                            <div class="row no-gutters">
                                <div Class="col-4">
                                <strong>Old ID: </strong>
                                </div>
                                <div Class="col-8">
                            ` +
                                item.oldID +
                                `
                                </div></br>
                            </div> </p>
                            </div>
                        </div>
                    </div>`;
                        });
                        html += `</div>
                        </div>
                        <div class="col-md-4 col-lg-2">
                                <div>
                                    <h3>Add Books</h3>
                                    `+yaha pe add karne ke liye select menu hai+`
                                    <select
                                        class="selectpicker mb-3 w-100"
                                        title="Select Book"
                                        data-style="btn-blue"
                                    >
                                        <option>Mustard</option>
                                        <option>Ketchup</option>
                                        <option>Relish</option>
                                    </select>
                                    <button
                                        type="button"
                                        class="btn btn-orange btn-block mb-5"
                                    >
                                        Add
                                    </button>
                                    <h3>Delete Books</h3>
                                     `+ yaha pe delete karne ke liye select menu hai +`
                                    <select
                                        class="selectpicker mb-3 w-100"
                                        title="Select Book"
                                        data-style="btn-blue"
                                    >
                                        <option>Mustard</option>
                                        <option>Ketchup</option>
                                        <option>Relish</option>
                                    </select>
                                    <button
                                        type="button"
                                        class="btn btn-orange btn-block mb-5"
                                    >
                                        Remove
                                    </button>
                                </div>
                            </div>
                            </div> `;
                    }
                },
            });
        });
    });
});
