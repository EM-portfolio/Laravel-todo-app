<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
  <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
  <script>
    flatpickr(document.getElementById('due_date'), { // #due_dateにピッカーを適用
      locale: 'ja',
      dateFormat: "Y/m/d",
      minDate: new Date() // 選択可能な最小の日付を指定
    });
  </script>