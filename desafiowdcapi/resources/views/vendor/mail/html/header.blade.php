<tr>
<td class="header">
<a href="{{ $url ?? '' }}" style="display: inline-block;">
@if (trim($slot ?? '') === 'Brinde')

@else
{{ $slot ?? '' }}
@endif
</a>
</td>
</tr>
