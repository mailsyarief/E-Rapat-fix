
    <script src="{{ asset('js/lib/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/lib/popper/popper.min.js') }}"></script>
    <script src="{{ asset('js/lib/tether/tether.min.js') }}"></script>
    <script src="{{ asset('js/lib/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>

    <script src="{{ asset('js/lib/datatables-net/datatables.min.js') }}"></script>
    
    <script type="text/javascript" src="{{ asset('js/lib/jqueryui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/lib/lobipanel/lobipanel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/lib/match-height/jquery.matchHeight.min.js') }}"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="{{ asset('js/lib/flatpickr/flatpickr.min.js') }}"></script>

    <script src="{{ asset('js/lib/jquery-tag-editor/jquery.caret.min.js') }}"></script>
    <script src="{{ asset('js/lib/jquery-tag-editor/jquery.tag-editor.min.js') }}"></script>
    <script src="{{ asset('js/lib/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/lib/select2/select2.full.min.js ') }}"></script>

    <script type="text/javascript" src="{{ asset('js/lib/moment/moment-with-locales.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/lib/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('js/lib/clockpicker/bootstrap-clockpicker.min.js') }}"></script>
    {{-- <script src="js/lib/clockpicker/bootstrap-clockpicker-init.js"></script> --}}
    <script src="{{ asset('js/lib/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/lib/bootstrap-select/bootstrap-select.min.js ') }}"></script>
    <script src="{{ asset('js/lib/prism/prism.js ') }}"></script>


    <script src="{{ asset('js/lib/summernote/summernote.min.js') }}"></script>

    <script src="{{ asset('js/lib/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    {{-- <script src="{{ asset('js/lib/bootstrap-notify/bootstrap-notify-init.js') }}"></script> --}}

    <script src="{{ asset('js/lib/bootstrap-sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/summernote-to-pdf.js') }}"></script>


  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>

  <script type="text/javascript" src="{{ asset('froala/js/froala_editor.min.js') }} "></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/align.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/char_counter.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/code_beautifier.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/code_view.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/colors.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/draggable.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/emoticons.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/entities.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/file.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/font_size.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/font_family.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/fullscreen.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/image.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/image_manager.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/line_breaker.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/inline_style.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/link.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/lists.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/paragraph_format.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/paragraph_style.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/quick_insert.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/quote.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/table.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/save.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/url.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/video.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/help.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/print.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/third_party/spell_checker.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/special_characters.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('froala/js/plugins/word_paste.min.js') }}"></script>

  <script src="https://rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script>


  <script type="text/javascript">
    $('#flatpickr').flatpickr();
  </script>

  <script type="text/javascript">
    function showfield(name){
      if(name=='Other')document.getElementById('div1').style.display="block"; 
      //innerHTML='Other: <input type="text" name="other" />';
      else document.getElementById('div1').style.display="none";
        //innerHTML='';
    }

    function hidefield(){
      document.getElementById('div1').style.display='none';
    }
  </script>

  <script src="{{ asset('js/app.js') }}"></script>