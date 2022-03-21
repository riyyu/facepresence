<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    {{-- <h1>Hello, world!</h1> --}}

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-md">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pricing</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown link
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="mt-2 container">
            <div class="text-center">
                <div class="card mb-2">
                    <div class="card-header">
                        Datang
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">-</li>
                    </ul>
                </div>

                <div class="card">
                    <div class="card-header">
                        Pulang
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">-</li>
                    </ul>
                </div>
            </div>
            <div class="mt-2">
                <div class="d-grid">
                    <button id="presence" class="btn btn-primary">Present</button>
                </div>
            </div>
        </div>
    </main>

    {{-- modal --}}
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Camera</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <video id="video" width="720" height="560" autoplay muted></video>
                    </div>

                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const video = document.getElementById("video");
            const videoModalContainer = document.getElementById("videoModal");
            const presenceButton = document.getElementById("presence")

            let videoStream;

            var videoModal = new bootstrap.Modal(videoModalContainer, {
                keyboard: false
            });

            presenceButton.addEventListener('click', function() {
                videoModal.show();
            });

            videoModalContainer.addEventListener('shown.bs.modal', async function(event) {
                // console.log(videoStream);
                videoStream = await navigator.mediaDevices.getUserMedia({
                    video: {}
                });
                video.srcObject = videoStream;
            });


            videoModalContainer.addEventListener('hidden.bs.modal', function(event) {
                videoStream.getTracks().forEach(function(track) {
                    track.stop();
                });
            });

        });
    </script>
</body>

</html>
