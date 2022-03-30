<html>
<body>
<h2>Demo Test Mail</h2>
<?php $jobs = \Illuminate\Support\Facades\DB::table('job_batches')->get();?>
<pre>
    {{ print_r($jobs) }}
</pre>
</body>
</html>
