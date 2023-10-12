<x-layout>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h5>Upload CSV</h5>
                    </div>
                    <div class="card-body">
                        <div id="upload-container" class="text-center">
                            <button id="browseFile" class="btn btn-primary">Browse File</button>
                        </div>
                        <div style="display: none" class="progress mt-3" style="height: 25px">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <table class="table table-striped" id="fileInfo">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">File Name</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="fileDate"></td>
                        <td id="fileName"></td>
                        <td id="fileStatus"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        let browseFile = document.getElementById('browseFile');
        let resumable = new Resumable({
            target: "/csv-uploader",
            query: {
                _token: "{{ csrf_token() }}"
            },
            fileType: ['csv', 'txt'],
            //chunkSize: 2 * 1024 * 1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        resumable.assignBrowse(browseFile);

        resumable.on('fileAdded', function(file) { // trigger when file picked
            showProgress();
            resumable.upload() // to actually start uploading.
        });

        resumable.on('fileProgress', function(file) { // trigger when file progress update
            updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', function(file, response) { // trigger when file upload complete
            response = JSON.parse(response)

            document.getElementById('fileDate').innerHTML = "";
            document.getElementById('fileName').innerHTML = response.name;
            document.getElementById('fileStatus').innerHTML = "Uploaded. Importing to Database... Please wait...";

            document.getElementById('browseFile').disabled = true;
            fetch('/csv-to-db', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        _token: "{{ csrf_token() }}",
                        filepath: response.path
                    })
                }).then(output => output.json())
                .then(data => {
                    document.getElementById('browseFile').disabled = false;
                    document.getElementById('fileStatus').innerHTML = "Imported to Database.";
                    console.log('Success:', data);
                })
                .catch((error) => {
                    alert('Error: ', error);
                    console.error('Error: ', error);
                });

        });

        resumable.on('fileError', function(file, response) { // trigger when there is any error
            alert('There is an error in uploading file. Please try again.')
        });

        let progress = document.getElementsByClassName('progress');

        function showProgress() {
            let progressBar = document.querySelector('.progress-bar');
            progressBar.style.width = '0%';
            progressBar.innerHTML = '0%';
            progressBar.classList.remove('bg-success');
            let progress = document.querySelector('.progress');
            progress.style.display = 'block';
        }

        function updateProgress(value) {
            let progressBar = document.querySelector('.progress-bar');
            progressBar.style.width = `${value}%`;
            progressBar.innerHTML = `${value}%`;

            if (value === 100) {
                document.querySelector('.progress-bar').classList.add('bg-success');
            }
        }

        function hideProgress() {
            progress.style.display = 'none';
        }
    </script>
</x-layout>
