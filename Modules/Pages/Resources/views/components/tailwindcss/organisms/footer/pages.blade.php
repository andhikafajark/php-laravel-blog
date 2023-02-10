<footer class="w-full border-t bg-white pb-6">
    <div class="w-full container mx-auto flex flex-col items-center">
        <div class="flex flex-col md:flex-row text-center md:text-left md:justify-between py-6">
            <a href="#" class="uppercase px-3">About Us</a>
            <a href="#" class="uppercase px-3">Privacy Policy</a>
            <a href="#" class="uppercase px-3">Terms & Conditions</a>
            <a href="#" class="uppercase px-3">Contact Us</a>
        </div>
        <div>&copy; {{ env('APP_NAME') }}</div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.19/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function () {
        globalHandler()
    })

    function globalHandler() {
        $('body').on('change', 'input[type="file"]', function (e) {
            const imagePreviewElement = $(e.target).siblings('[data-type="image-preview"]')

            if (!e.target?.files?.length) {
                return imagePreviewElement
                    .removeClass('border mt-3 hidden')
                    .attr('src', '')
            }

            const mimeType = e.target.files[0].type

            if (mimeType.split('/')[0] !== 'image') {
                return imagePreviewElement
                    .removeClass('border mt-3 hidden')
                    .attr('src', '')
            }

            return imagePreviewElement
                .addClass('border mt-3')
                .attr('src', URL.createObjectURL(e.target.files[0]))
                .removeClass('hidden')
        })
    }

    async function callApiWithForm(form, options = {}) {
        const url = $(form).attr('action')
        const method = $(form).attr('method')
        const formData = new FormData(form)

        $(form).find('input[type="checkbox"]').each(function (_, element) {
            formData.set($(element).attr('name'), $(element).is(':checked') ? 1 : 0)
        })

        return apiCall({
            url,
            type: method,
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            beforeSend: function () {
                $(form).find('.error').hide()
                $(form).find('button[type="submit"]').attr('disabled', true)
            },
            success: function (response) {
                if (response?.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response?.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            error: function (response) {
                const responseJSON = response?.responseJSON

                if (response?.status === 422) {
                    for (const [key, value] of Object.entries(responseJSON?.data)) {
                        const type = $(form).find(`[name="${key}"]`).attr('type')

                        if (type === 'file') {
                            $(form).find(`[name="${key}"]`).parent().siblings('.error').html(value).css('display', 'block')
                        } else {
                            $(form).find(`[name="${key}"]`).siblings('.error').html(value).css('display', 'block')
                        }
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: responseJSON?.message,
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
            },
            complete: function () {
                $(form).find('button[type="submit"]').attr('disabled', false)
            },
            ...options
        })
    }

    async function apiCall(options = {}) {
        return $.ajax({
            success: function (response) {
                if (response?.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response?.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            error: function (response) {
                Swal.fire({
                    icon: 'error',
                    title: response?.responseJSON?.message,
                    showConfirmButton: false,
                    timer: 1500
                })
            },
            ...options,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                ...options?.headers
            },
        })
    }
</script>

@stack('scripts')

</body>
</html>
