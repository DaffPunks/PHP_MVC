class Feedback {

    constructor(id, button) {
        this._id = id;
        this._edit = false;

        button.addEventListener("click", () => {
            if (this._edit) {
                this.closeEditForm();
                this._edit = false;
            } else {
                this.openEditForm();
                this._edit = true;
            }
        });
    }

    openEditForm() {
        let mainDiv = $(".feedback[data-id='" + this._id + "']");

        let name = mainDiv.find(".feedback-name").text();
        let email = mainDiv.find(".feedback-email").text();
        let text = mainDiv.find(".feedback-text").text();

        let newForm =
            '<div class="new-form">' +
            '<form action="feedback/edit?id=' + this._id + '" method="post">' +
            '<div class="form-group">' +
            '<input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Имя" value="' + name + '">' +
            '</div>' +
            '<div class="form-group">' +
            '<input type="email" class="form-control" name="email" id="exampleInputPassword1" placeholder="Email" value="' + email + '">' +
            '</div>' +
            '<div class="form-group">' +
            '<textarea class="form-control" rows="5" name="text" placeholder="Текст">' + text + '</textarea>' +
            '</div>' +
            '<div>' +
            '<button type="submit" class="btn btn-success">Отправить</button>' +
            '</div>' +
            '</form>' +
            '</div>';

        $('.feedback[data-id="' + this._id + '"]').append(newForm);
    }

    closeEditForm() {
        $(".feedback[data-id='" + this._id + "'] .new-form").remove();
    }
}

for (let button of document.querySelectorAll(".feedback-edit")) {
    new Feedback(button.dataset.id, button);
}

document.querySelector(".btn-preview").addEventListener("click", () => {
    let name = $('input[name="name"]').val();
    let email = $('input[name="email"]').val();
    let text = $('textarea[name="text"]').val();
    let image = $('input[name="image"]')[0].files[0].name;
    alert(image);

    if(!name || !email || !text) {
        alert("Введите значения");
    } else {
        $(".feedback-example").remove();

        let previewFeedback =
            '<div class="feedback feedback-example">' +
            '<h3 class="feedback-name">' + name + '</h3>' +
            '<h4 class="feedback-email">' + email + '</h4>' +
            '<h4 class="feedback-text">' + text + '</h4>' +
            '</div>';

        $(".feedbacks-container").append(previewFeedback);
    }

});
