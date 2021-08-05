
$(document).ready(function () {
	$("#voiceSearchSubmit").on("click", function () {
		search = $("#search").val();
		$.ajax({
			type: "POST",
			url: "addBook/googleBook.php",
			data: {
				search: search
			},
			success: function (data) {
				var nocache = 1;
				var internet = 1;
				html = `<div class="text-center">
                	<a class="btn btn-blue mb-5" href="external.php?q=`+ search + `" target="_blank">Springer Search</a>
                    </div>
                    <h4 class="text-center mb-5">Showing Results for '`+ search + `'</h4>
					<div class="row row-cols-1">`;
					
				if (data != 'Failed') {
					data = JSON.parse(data);
					title = data.title;
					imgLink = data.imgLink;
					author = data.author;
					category = data.category;
					publisher = data.publisher;
					publishedDate = data.publishedDate;
					isbn = data.isbn;
					pageCount = data.pageCount;
					country = data.country;
					money = data.money;
					preview = data.preview;
					length = data.title.length;
					chat = 1;
					nocache = 0;

					cacheData['title'] = title;
					cacheData['author'] = author;
					cacheData['category'] = category;
					cacheData['publisher'] = publisher;
					cacheData['publishedDate'] = publishedDate;
					cacheData['isbn'] = isbn;
					cacheData['country'] = country;
					cacheData['pageCount'] = pageCount;
					cacheData['money'] = money;
					cacheData['imgLink'] = imgLink;
					cacheData['preview'] = preview;
					cacheData['lastID'] = lastID;
					search = search.toLowerCase();
					localStorage.setItem("cacheData " + search, JSON.stringify(cacheData));
				} else {
					var searchQ = search.toLowerCase().split(' ');
					var keys = Object.keys(localStorage).filter(key => key.includes('cacheData'));
					keys.forEach((key) => {
						var cachedSearch = key.slice(10).split(' ');
						if (searchQ.filter((value) => cachedSearch.includes(value)).length > 0) {
							var data = JSON.parse(localStorage.getItem(key));
							title = data.title;
							imgLink = data.imgLink;
							author = data.author;
							category = data.category;
							publisher = data.publisher;
							publishedDate = data.publishedDate;
							isbn = data.isbn;
							pageCount = data.pageCount;
							country = data.country;
							money = data.money;
							preview = data.preview;
							length = data.title.length;
							chat = 1;
							nocache = 0;
							internet = 0;
						};
					});
				}
				if (nocache == 0 && internet == 0)
					html += `
					<div class="mb-4 text-center">This is cache of Add Books Page for searching "`+ search + `". The current page could have changed in the meantime.</div>`;
				for (var i = 0; i < length; i++) {
					
					html += `<div class="col">
							<div class="card mb-3 ml-auto mr-auto" style="max-width: 950px;">
									<div class="row no-gutters">
										<div class="col-md-4">`;
					if (imgLink[i]) {
						html += `   <img src=" ` + imgLink[i] + ` " class="card-img" alt="..." style="max-height: 300px; width: 100%" />`;
					}
					html += `     </div>
										<div class="col-md-6">
											<div class="card-body">
												<h5 class="card-title">`;
					title[i] ? html += `Title: ` + title[i] : null
					html += `</h5>
												<p>`;
					author[i] ? html += `Author: ` + author[i] : null
					category[i] ? `<br>Category: ` + category[i] : null;
					publisher[i] ? `<br>Publisher: ` + publisher[i] : null;
					publishedDate[i] ? `<br>Published Date: ` + publishedDate[i] : null;
					isbn[i] ? `<br>ISBN: ` + isbn[i] : null;
					pageCount[i] ? `<br>Page Count: ` + pageCount[i] : null;
					country[i] ? html += `<br>Country: ` + country[i] : null;
					money[i] ? html += `<br>Amount: ` + money[i] : null;
					html += `</p>
											</div>
										</div>
										<div class="col-md-2 align-self-center justify-content-center p-3">
											<h1 class="display-2 text-center"> `+ (i + 1) + ` </h1>
											<button type="button" data-toggle="modal" data-target=".bd-example-modal-xl" class="btn btn-orange btn-block mb-4"; " onclick="autoFill(`+ i + `)">
												Add
											</button>
											<button type="button" class="btn btn-blue btn-block" onclick="window.open('`+ preview[i] + `', '_blank')">
												Preview
											</button>
										</div>
									</div>
								</div>
							</div>`;
				}
				startGreeting();
				if (nocache) {
					html = 'No cache for this search';
				}
				html += `</div>`;
				$("#searchResults").html(html);

			},
			error: function (e) {
				alert(e);
			}
		});
	})
})



