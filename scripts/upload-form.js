document.addEventListener("DOMContentLoaded", () => {
  const URL = "./api/upload-files.php";
  const uploadFrom = document.forms.uploadForm;
  const fileInput = document.querySelector("#file_input");
  const uploadedFiles = document.querySelector(".uploaded_files");

  uploadFrom.addEventListener("submit", (e) =>
    handlerSubmit(e, fileInput, URL)
  );

  fileInput.addEventListener("change", () =>
    handlerGetFileName(fileInput, uploadedFiles)
  );
});

function handlerSubmit(e, fileInput, URL) {
  e.preventDefault();

  const files = fileInput.files;
  const fromData = new FormData();
  fromData.append("files", files);

  sendRequest(URL, FormData);
}

async function sendRequest(url, data) {
  try {
    const request = await fetch(url, {
      method: "POST",
      body: data,
    });

    const response = await request.json();
    console.log(response);
  } catch (error) {
    console.log(error);
  }
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
