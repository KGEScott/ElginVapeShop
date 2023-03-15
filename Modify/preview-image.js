function previewImage(event) {
	var input = event.target;
	var preview = document.getElementById('image-preview');

	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function(e) {
			preview.setAttribute('src', e.target.result);
		}

		reader.readAsDataURL(input.files[0]);
	}
}
function showErrorPopup(message) {
  var popup = document.getElementById("error-popup");
  var error = document.getElementById("error-message");
  error.innerHTML = message;
  popup.style.display = "block";

  var closeBtn = document.getElementsByClassName("popup-close")[0];
  closeBtn.onclick = function() {
    popup.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == popup) {
      popup.style.display = "none";
    }
  }
}