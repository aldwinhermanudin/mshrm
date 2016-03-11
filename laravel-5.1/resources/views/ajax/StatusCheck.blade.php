@if (empty($results))
  <div class="callout callout-success">
    <h5>No feedback.</h5>
  </div>
@else
  @foreach ($results as $result)
  <div class="callout callout-warning">
    <ul>
	  <li><b>Total rejected entries: </b>{{ $result->error_count }}</li>
	  <li><b>Detail of rejected entries: </b>{{ str_replace(",",", ",$result->values) }}</li>
	  <li><b>Timestamp: </b>{{ $result->timestamp }}</li>
    </ul>
  </div>
  @endforeach
@endif
