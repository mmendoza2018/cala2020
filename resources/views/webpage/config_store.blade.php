<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Configuración Tienda WhatsApp</title>
    <link rel="stylesheet" href="{{ URL::to('assets/css/custom-style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', sans-serif;
    }

    /* STYLES FOR DROPZONE  */
    .dropzone-container {
        border: 2px dashed rgba(0, 0, 0, 0.3);
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        margin: 10px auto;
        max-width: 600px;
        width: 100%
    }

    .dropzone-container-sm {
        border: 2px dashed rgba(0, 0, 0, 0.3);
        border-radius: 5px;
        text-align: center;
        max-width: 600px;
        min-height: 80px;
        width: 100%;
    }

    .dropzone-previews {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
    }

    .dz-preview {
        position: relative;
        width: 150px;
        height: auto;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
    }

    .dz-preview-sm {
        position: relative;
        width: 80px;
        height: auto;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
    }

    .dz-image {
        overflow: hidden;
        border-radius: 5px;
    }

    .dz-image img {
        object-fit: contain !important;
        width: 100%;
        height: auto;
        aspect-ratio: 16 / 16;
    }

    .dz-remove-button {
        position: absolute;
        top: -10px;
        left: -10px;
        width: 30px;
        height: 30px;
        color: white;
        background-color: #dc3545;
        border: none;
        padding: 5px;
        border-radius: 100%;
        cursor: pointer;
    }

    .dz-remove-button:hover {
        background-color: #c82333;
    }

    .primary-image-checkbox {
        position: absolute;
        bottom: 10px;
        right: 10px;
    }

    .dz-filename {
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        max-width: 145px !important;
    }

    /* END STYLES FOR DROPZONE */
</style>

<body>
    <div class="config-store" data-base_url="{{ url('/') }}">
        <div class="config-container">
            <header class="config-header">
                <img src="https://ideogram.ai/assets/image/lossless/response/p2kdjYNCRfisaT43NezGdg"
                    alt="Logo de la empresa" style="border-radius: 100%;" class="config-logo" />
            </header>
            <form id="formConfigStore" autocomplete="off">
                <div class="slides">
                    <div class="slide slide-config-custom active" data-slide="1">
                        <h2>Información General</h2>
                        <hr>
                        <input type="text" placeholder="Nombre de la tienda" name="name_store" autocomplete="off"/>
                        <input type="text" placeholder="Descripción breve" name="description" autocomplete="off"/>
                        <div id="dropzoneContainerAdd" class="dropzone-container">
                            <div id="dropzoneAdd">
                                Sube tu Logo aqui.
                            </div>
                            <div id="dropzonePreviewAdd" class="dropzone-previews"></div>
                        </div>
                    </div>

                    <div class="slide slide-config-custom" data-slide="2">
                        <h2>Datos de Contacto</h2>
                        <hr>
                        <input type="text" placeholder="Número de WhatsApp" autocomplete="off" name="phone_number" />
                        <input type="email" required placeholder="Correo electrónico (opcional)" name="email" autocomplete="off"/>
                        <input type="text" placeholder="Dirección física (si aplica)" name="adress" autocomplete="off" />
                    </div>

                    <div class="slide slide-config-custom" data-slide="3">
                        <h2>Datos de la Tienda</h2>
                        <hr>
                        <div class="row">
                            <div class="color-field">
                                <label>Color principal</label>
                                <input type="color" name="primary_color" value="#1E90FF" />
                            </div>
                            <div class="color-field">
                                <label>Color secundario</label>
                                <input type="color" name="secondary_color" value="#e1e1e1" />
                            </div>
                        </div>

                        <label><input type="checkbox" name="active_brand" /> ¿Usar marcas?</label>
                        <label><input type="checkbox" name="active_subcategory" /> ¿Usar subcategorías?</label>

                        <select name="type_store">
                            <option disabled selected>Selecciona el tipo de tienda</option>
                            <option value="Ropa">Ropa</option>
                            <option value="Tecnologia">Tecnología</option>
                            <option value="Hogar">Hogar</option>
                            <option value="Iniciar desde 0">Hogar</option>
                        </select>
                    </div>

                    <div class="slide slide-config-custom" data-slide="4" style="text-align: center">
                        <h2>Generando tienda...</h2>
                        <p>Estamos creando tu tienda automáticamente. Esto puede tardar unos segundos.</p>
                        <video autoplay muted loop playsinline width="70%" style="text-align: center; margin: auto">
                            <source src="{{ URL::to('assets/images/ai2.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </form>

            <div class="config-navigation">
                <button id="prevBtn">Anterior</button>
                <button id="nextBtn">Siguiente</button>
            </div>
        </div>
    </div>

    <!-- Template de Previsualización -->
    <script type="text/template" id="preview-template">
        <div class="dz-preview dz-file-preview">
            <div class="dz-image">
                <img data-dz-thumbnail />
            </div>
            <div class="dz-details">
            </div>

            <!--  <input type="checkbox" class="primary-image-checkbox" data-tooltip="default" data-tooltip-content="test tooltip"/> -->
            <i class="ri-close-line dz-remove-button">X</i>
                
        </div>
    </script>
    <script src="{{ URL::to('assets/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="index.js"></script>
    <script>
        const slides = document.querySelectorAll(".slide");
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");

        let currentSlide = 0;

        function animateSlideOut(index) {
            return gsap.to(slides[index], {
                duration: 0.5,
                x: -50,
                opacity: 0,
                ease: "power2.inOut",
            });
        }

        function animateSlideIn(index) {
            gsap.set(slides[index], {
                x: 50,
                opacity: 0,
                display: "flex"
            });
            gsap.to(slides[index], {
                duration: 0.5,
                x: 0,
                opacity: 1,
                ease: "power2.out",
            });
        }

        function showSlide(index) {
            animateSlideOut(currentSlide).then(() => {
                slides[currentSlide].classList.remove("active");
                slides[currentSlide].style.display = "none";
                currentSlide = index;
                slides[currentSlide].classList.add("active");
                animateSlideIn(currentSlide);

                prevBtn.style.display = currentSlide === 0 ? "none" : "inline-block";
                nextBtn.innerText = currentSlide === slides.length - 1 ? "Finalizar" : "Siguiente";
            });
        }

        prevBtn.addEventListener("click", () => {
            if (currentSlide > 0) {
                showSlide(currentSlide - 1);
            }
        });

        nextBtn.addEventListener("click", () => {
            const isPenultimate = currentSlide === slides.length - 2;

            const valid = validateCurrentSlide();
            if (!valid) return;

            if (isPenultimate) {
                enviarData(); // ejecuta en penúltimo
            }

            if (currentSlide < slides.length - 1) {
                showSlide(currentSlide + 1);
            }
            setTimeout(() => {
                const slideActive = document.querySelector("[data-slide='4']");
                if (slideActive && slideActive.classList.contains("active")) {
                    const containerBtns = document.querySelector(".config-navigation");
                    containerBtns.style.display = "none";
                }
            }, 1000);
        });

        showSlide(0);

        const initDropzone = (container, element, dropzonePreviewElement, files = false) => {
            const dropzoneSelector = `#${container}, #${element}`;
            // 🔴 1. Destruir instancia previa si existe
            Dropzone.instances.forEach((dz) => {
                if (dz.element.matches(dropzoneSelector)) {
                    dz.destroy();
                }
            });

            dropzoneGlobal = null;

            const previewTemplate = document.querySelector("#preview-template").innerHTML;
            // Destruye instancias anteriores si existen

            dropzoneGlobal = new Dropzone(`#${container}, #${element}`, {
                url: "https://httpbin.org/post", // URL ficticia, no se usará aún
                method: "post",
                previewTemplate: previewTemplate,
                previewsContainer: `#${dropzonePreviewElement}`,
                clickable: `#${container}, #${element}`, // Click solo dentro del área de Dropzone
                autoProcessQueue: false, // No subir automáticamente
                addRemoveLinks: false, // Usamos nuestro propio botón de eliminar
                maxFiles: 1, // Permitir solo un archivo
                acceptedFiles: "image/*", // Solo aceptar imágenes
                thumbnailWidth: null,
                thumbnailHeight: null,
            });

            dropzoneGlobal.on("thumbnail", (file, dataUrl) => {
                const thumbnail = file.previewElement.querySelector("[data-dz-thumbnail]");
                if (thumbnail) {
                    thumbnail.style.objectFit = "contain";
                }
            });

            dropzoneGlobal.on("addedfile", (file) => {
                // Elimina anteriores si hay más de uno
                if (dropzoneGlobal.files.length > 1) {
                    const filesToRemove = dropzoneGlobal.files.filter(f => f !== file);
                    filesToRemove.forEach(f => dropzoneGlobal.removeFile(f));
                }

                const removeButton = file.previewElement.querySelector(
                    `#${container} .dz-remove-button`);
                if (removeButton) {
                    removeButton.addEventListener("click", (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        dropzoneGlobal.removeFile(file);
                    });
                }
            });

            if (files) {
                files.forEach(file => {
                    const mockFile = {
                        name: file.name,
                        size: file.size,
                        url: file.url,
                        isMock: true
                    };

                    dropzoneGlobal.emit("addedfile", mockFile);
                    dropzoneGlobal.emit("thumbnail", mockFile, file.url);
                    dropzoneGlobal.emit("complete", mockFile);

                    dropzoneGlobal.files.push(mockFile);
                });
            }
        }

        function validateCurrentSlide() {
            const currentSlideEl = slides[currentSlide];
            const inputs = currentSlideEl.querySelectorAll('input[type="text"], input[type="email"]');
            const selects = currentSlideEl.querySelectorAll('select');
            let isValid = true;

            // Limpiar estados previos
            [...inputs, ...selects].forEach(el => {
                el.style.boxShadow = 'inset 0 2px 6px rgba(0, 0, 0, 0.1)'; // Estilo normal
            });

            inputs.forEach(input => {
                if (input.value.trim() === '') {
                    input.style.boxShadow = '0 0 0 2px red';
                    isValid = false;
                }
            });

            selects.forEach(select => {
                if (!select.value || select.selectedIndex === 0) {
                    select.style.boxShadow = '0 0 0 2px red';
                    isValid = false;
                }
            });

            return isValid;
        }

        async function enviarData() {
            try {
                const formData = new FormData(document.getElementById("formConfigStore"));
                let active_brand = document.querySelector(`#formConfigStore [name="active_brand"]`).checked ?
                    "1" : "0";
                let active_subcategory = document.querySelector(`#formConfigStore [name="active_subcategory"]`)
                    .checked ? "1" : "0";

                formData.append("active_brand", active_brand);
                formData.append("active_subcategory", active_subcategory);

                const images = await getImageDropzone();
                formData.append("logo", images[0]);

                const options = {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                };
                const response = await fetch('/configStore/create', options);
                const data = await response.json();
                console.log('(luismi): data :>> ', data);
                if (data.success) {
                    setTimeout(() => {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Tienda Creada Correctamente",
                            showConfirmButton: false,
                            timer: 2000,
                        });
                        setTimeout(() => {
                            let baseUrl = document.querySelector(`[data-base_url]`).dataset.base_url;
                            location.href = baseUrl;
                        }, 2100);
                    }, 5000);
                } else {
                    boxAlertValidation(data.errors)
                }
            } catch (error) {
                console.log('(luismi): error :>> ', error);
            }
        }


        initDropzone('dropzoneContainerAdd', 'dropzoneAdd', 'dropzonePreviewAdd', false);

        const getImageDropzone = async () => {
            const filesToUpload = dropzoneGlobal.files;
            const filesFinal = [];

            for (const file of filesToUpload) {
                if (file instanceof File) {
                    // Archivo real, simplemente lo agregamos
                    filesFinal.push(file);
                } else if (file.url) {
                    // Mock file: convertir a File desde URL
                    try {
                        const response = await fetch(file.url);
                        const blob = await response.blob();
                        const realFile = new File([blob], file.name, {
                            type: blob.type,
                        });
                        filesFinal.push(realFile);
                    } catch (err) {
                        console.error("Error al convertir mock a File:", err);
                    }
                }
            }

            return filesFinal;
        };

        const boxAlertValidation = (messages) => {
            const messageList = messages.map(message => `<li>${message}</li>`).join('');
            const messageHTML = `<ul>${messageList}</ul>`;

            Swal.fire({
                position: "center",
                icon: "error",
                title: "Error de validación",
                html: messageHTML,
                confirmButtonText: 'Aceptar'
            });
        }
    </script>
</body>

</html>
