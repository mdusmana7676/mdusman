$(document).ready(function () {

    $("#searchBtn").click(function () {
        searchBooks();
    });

    $("#bookName").keypress(function (event) {
        if (event.which === 13) {
            searchBooks();
        }
    });

    function searchBooks() {
        let bookName = $("#bookName").val().trim();

        if (bookName === "") {
            $("#message").html("<p class='error'>Please enter a book title.</p>");
            $("#bookList").empty();
            return;
        }

        $("#message").html("Loading books...");
        $("#bookList").empty();

        $.ajax({
            url: "https://openlibrary.org/search.json",
            type: "GET",
            data: {
                title: bookName,
                limit: 12
            },
            dataType: "json",

            success: function (data) {
                $("#bookList").empty();

                if (data.docs.length === 0) {
                    $("#message").html("<p>No books found.</p>");
                    return;
                }

                $("#message").html(
                    "<p>Found " + data.numFound + " books.</p>"
                );

                $.each(data.docs, function (index, book) {

                    let title = book.title || "Unknown Title";
                    let author = book.author_name
                        ? book.author_name.join(", ")
                        : "Unknown Author";

                    let year = book.first_publish_year || "Not available";

                    let image = book.cover_i
                        ? "https://covers.openlibrary.org/b/id/" + book.cover_i + "-M.jpg"
                        : "";

                    let cover = image
                        ? $("<img>").attr("src", image).attr("alt", title)
                        : $("<p>").text("Cover not available");

                    let card = $("<div>").addClass("book-card");

                    card.append(cover);
                    card.append($("<h3>").text(title));
                    card.append($("<p>").text("Author: " + author));
                    card.append($("<p>").text("Published: " + year));

                    let link = $("<a>")
                        .attr("href", "https://openlibrary.org" + book.key)
                        .attr("target", "_blank")
                        .attr("rel", "noopener noreferrer")
                        .text("View Book");

                    card.append(link);

                    $("#bookList").append(card);
                });
            },

            error: function () {
                $("#message").html(
                    "<p class='error'>Unable to fetch books. Please try again.</p>"
                );
            }
        });
    }

});