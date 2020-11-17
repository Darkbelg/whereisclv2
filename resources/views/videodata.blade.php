<script>
    var app = @json($response, JSON_PRETTY_PRINT);
</script>

{!! $response["items"][0]["player"]["embedHtml"] !!}
