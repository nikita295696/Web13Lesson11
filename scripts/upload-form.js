const params = window.location.search
  .replace("?", "")
  .split("&")
  .reduce(function (p, e) {
    const a = e.split("=");
    p[decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
    return p;
  }, {});

const URL = `api/upload-files.php${
  !!params ? "?current_dir=" + params.current_dir : ""
}`;

document.addEventListener("DOMContentLoaded", () => {
  const uploadFrom = document.forms.uploadForm;
  const fileInput = document.querySelector("#file_input");
  const uploadedFiles = document.querySelector(".uploaded_files");

  uploadFrom.addEventListener("submit", (e) => handlerSubmit(e));

  fileInput.addEventListener("change", () =>
    handlerGetFileName(fileInput, uploadedFiles)
  );
});

function handlerSubmit(e) {
  e.preventDefault();

  uploadFile();
}

function handlerGetFileName(fileInput, uploadedFiles) {
  const files = fileInput.files;
  createFileDescription(files, uploadedFiles);
}

function createFileDescription(file, uploadedFiles) {
  const filesArray = Object.values(file);
  uploadedFiles.innerHTML = "";
  if (file.length) {
    filesArray.map((file) => {
      const description = document.createElement("span");
      const fileName = file.name;
      const format = fileName.slice(fileName.lastIndexOf("."));

      if (fileName.length > 30) {
        description.textContent = fileName.slice(0, 30) + "..." + format;
      } else {
        description.textContent = fileName;
      }

      uploadedFiles.append(description);
    });
  }
}

function uploadFile() {
  const totalfiles = document.getElementById("file_input").files.length;
  if (totalfiles > 0) {
    const formData = new FormData();

    for (let index = 0; index < totalfiles; index++) {
      formData.append(
        "files[]",
        document.getElementById("file_input").files[index]
      );
    }

    const xhttp = new XMLHttpRequest();

    xhttp.open("POST", URL, true);
    xhttp.send(formData);
  } else {
    alert("Please select a file");
  }
}
