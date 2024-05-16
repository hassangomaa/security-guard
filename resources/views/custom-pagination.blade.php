<style>
.pagination {
    display:flex;
    padding:8px;
    width:100%;
    justify-content:center;
    align-items:center:
}
.listt {
    position: relative;
    display: inline-block;
    font-family: Arial, sans-serif;
    margin-right: 8px;
}
.pagination-dropdown{
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    cursor: pointer;
    width: 98%;
    background-color: #003E7E;
    color: white;
    font-family: 'Roboto Slab';
}
.options {
    margin: 10px;
    background-color: #003E7E;
    color: white;
    font-size: 20px;
    font-family: 'Roboto Slab';
}
.arrow-replace {
    cursor: pointer;
    min-width: fit-content;
    height: 100%;
    background-color:#444444;
    text-decoration: none;
    color: #0A2C58;
    margin-right: 10px;
    font-weight: bold;
    font-size: 16px;
    transition: 0.5s;
    height: 20px;
    width: 20px;
    border-radius: 4px;
    padding: 16px;
    display: flex;
    justify-content: center;
    align-items: center;
    align-self: center;
}
.arrow-replace:hover {
    background-color:#003E7E;
    color:white;
}
.diss {
    display: flex;
    justify-content: center;
    align-items: center;
    padding:10px;
}
</style>

@if ($paginator->hasPages())
    <ul class="pagination" style="color: #0A2C58">
        @if ($paginator->onFirstPage())
            <li class="disabled"><span class="diss">Beginning</span></li>
        @else
            <li class="arrow-replace"><a href="{{ $paginator->previousPageUrl() }}"  rel="prev"><<</a></li>
        @endif
        <li class="listt">
            <select class="pagination-dropdown" onchange="window.location.href = this.value;">
                @for ($page = 1; $page <= $paginator->lastPage(); $page++)
                    <option class="options" value="{{ $paginator->url($page) }}"{{ $page == $paginator->currentPage() ? ' selected' : '' }}>
                        {{ $page }}
                    </option>
                @endfor
            </select>
        </li>
        @if ($paginator->hasMorePages())
            <li class="arrow-replace"><a href="{{ $paginator->nextPageUrl() }}"  rel="next">>></a></li>
        @else
            <li class="disabled"><span class="diss">End</span></li>
        @endif
    </ul>
@endif
