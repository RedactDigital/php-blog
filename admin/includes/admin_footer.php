    </div>


    <!-- /#wrapper -->

    <!-- jQuery -->
    <script>
        ClassicEditor
            .create(document.querySelector('#body'), {

                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'underline',
                        'link',
                        '|',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'indent',
                        'outdent',
                        'alignment',
                        '|',
                        'fontFamily',
                        'fontSize',
                        'fontColor',
                        'fontBackgroundColor',
                        '|',
                        'CKFinder',
                        'mediaEmbed',
                        'blockQuote',
                        '|',
                        'codeBlock',
                        'insertTable',
                        'specialCharacters',
                        '|',
                        'undo',
                        'redo'
                    ]
                },
                language: 'en',
                image: {
                    toolbar: ['imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:full', 'imageStyle:alignRight'],

                    styles: [
                        // This option is equal to a situation where no style is applied.
                        'full',

                        // This represents an image aligned to the left.
                        'alignLeft',

                        // This represents an image aligned to the right.
                        'alignRight'
                    ]
                },
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells',
                        'tableCellProperties',
                        'tableProperties'
                    ]
                },
                alignment: {
                    toolbar: ['alignment'],
                },
                ckfinder: {
                    uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                },
                indentBlock: {
                    offset: 2,
                    unit: 'em'
                },
                licenseKey: '',

            })
            .then(editor => {
                window.editor = editor;
                const wordCountPlugin = editor.plugins.get('WordCount');
                const wordCountWrapper = document.getElementById('word-count');
                wordCountWrapper.appendChild(wordCountPlugin.wordCountContainer);



            })
            .catch(error => {
                console.error('Oops, something gone wrong!');
                console.error('Please, report the following error in the https://github.com/ckeditor/ckeditor5 with the build id and the error stack trace:');
                console.warn('Build id: rtfwnt4nxhbl-8o65j7c6blw0');
                console.error(error);
            });
    </script>


    <script src="js/scripts.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    </body>

    </html>