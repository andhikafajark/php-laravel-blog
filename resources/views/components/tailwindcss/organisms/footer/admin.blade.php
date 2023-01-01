</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.19/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function () {
        globalHandler()
    })

    function globalHandler() {
        $('#toogleSideBar').on('click', function () {
            $('#mobile-nav').removeClass('translate-x-[-260px]')
            $('#overlay').removeClass('hidden')
        })

        $('#overlay').on('click', function () {
            $('#mobile-nav').addClass('translate-x-[-260px]')
            $('#overlay').addClass('hidden')
        })

        $('[aria-controls="menu-dropdown"]').on('click', function () {
            const target = $(this).data('collapse-toggle')

            $(this).find('[aria-controls="menu-dropdown-icon"]').toggleClass('-rotate-90')

            const targetElement = $(this).siblings(`#${target}`)

            targetElement.toggleClass('hidden')
        })

        $('#logout').on('click', function (e) {
            e.preventDefault()

            const url = $(this).attr('href')

            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Yes, logout!'
            }).then((result) => {
                if (result.isConfirmed) {
                    apiCall({
                        url,
                        success: function (response) {
                            if (response?.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: response?.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    window.location.href = response.data?.route
                                })
                            }
                        }
                    })
                }
            })
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

</html>
