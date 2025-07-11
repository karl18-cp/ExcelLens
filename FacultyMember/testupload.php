<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Test PDF Upload with Modal</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 40px;
      background-color: #f4f4f4;
    }
    .btn {
      padding: 8px 14px;
      font-size: 14px;
    }
  </style>
</head>
<body>

  <h2>📄 Test Upload Class List</h2>

  <div style="display: flex; gap: 10px; align-items: center; margin-top: 20px;">
    <button class="btn btn-primary"
            onclick="document.getElementById('classListFile').click()">
      <i class="fas fa-upload"></i>Upload Class List
    </button>

    <input type="file" id="classListFile" accept=".pdf" style="display: none;">
  </div>

  <!-- ✅ Bootstrap Modal -->
  <div class="modal fade" id="confirmUploadModal" tabindex="-1" aria-labelledby="confirmUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmUploadModalLabel">Confirm Upload</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to upload <strong id="filenamePreview"></strong>?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="button" class="btn btn-success" onclick="confirmUploadedFile()">Yes, Upload</button>
        </div>
      </div>
    </div>
  </div>

  <!-- ✅ Bootstrap + JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    let uploadedFile = null;

    document.getElementById('classListFile').addEventListener('change', function () {
      uploadedFile = this.files[0];
      if (!uploadedFile) return;

      console.log(`Selected file: "${uploadedFile.name}"`);

      // Show modal and update filename
      document.getElementById('filenamePreview').textContent = uploadedFile.name;

      const confirmModal = new bootstrap.Modal(document.getElementById('confirmUploadModal'));
      confirmModal.show();
    });

    function confirmUploadedFile() {
      if (!uploadedFile) {
        console.warn("No file uploaded.");
        return;
      }

      console.log(`✅ Confirmed: "${uploadedFile.name}" will now be sent.`);

      const formData = new FormData();
      formData.append('pdf', uploadedFile);

      fetch('insert_students_from_pdf.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        console.log(data.message || 'Upload complete.');
      })
      .catch(err => {
        console.error('Upload failed:', err.message);
      });

      // Optional: hide modal after confirming (Bootstrap handles it)
      const modal = bootstrap.Modal.getInstance(document.getElementById('confirmUploadModal'));
      modal.hide();
    }
  </script>

</body>
</html>
