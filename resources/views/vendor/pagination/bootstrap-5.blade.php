@if ($paginator->hasPages())
    <style>
        .pagination-lux {
            display: flex;
            padding-left: 0;
            list-style: none;
            justify-content: center;
            gap: 8px;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .pagination-lux .page-item .page-link {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            color: var(--lux-purple-dark, #1A0B2E);
            background-color: transparent;
            border: 1px solid rgba(26, 11, 46, 0.2);
            border-radius: 50%;
            font-family: 'Cinzel', serif;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .pagination-lux .page-item:not(.disabled):not(.active) .page-link:hover {
            z-index: 2;
            color: #fff;
            background-color: var(--lux-purple-dark, #1A0B2E);
            border-color: var(--lux-purple-dark, #1A0B2E);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(26, 11, 46, 0.3);
        }

        .pagination-lux .page-item.active .page-link {
            z-index: 3;
            color: var(--lux-purple-dark, #1A0B2E);
            background-color: var(--lux-gold, #D4AF37);
            border-color: var(--lux-gold, #D4AF37);
            box-shadow: 0 4px 10px rgba(212, 175, 55, 0.4);
            transform: scale(1.05);
        }

        .pagination-lux .page-item.disabled .page-link {
            color: #ccc;
            pointer-events: none;
            background-color: transparent;
            border-color: #eee;
        }
        
        .pagination-info {
            font-family: 'Cinzel', serif;
            color: #666;
            letter-spacing: 1px;
            font-size: 0.9rem;
            text-transform: uppercase;
        }
    </style>

    <nav aria-label="Page navigation" class="w-100 mt-5">
        <div class="d-flex flex-column align-items-center">
            
            <ul class="pagination-lux">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="page-link" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="fas fa-chevron-left"></i></a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="fas fa-chevron-right"></i></a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="page-link" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                    </li>
                @endif
            </ul>

            <div class="pagination-info mt-3 text-center w-100">
                {!! __('Showing') !!} <span class="fw-bold" style="color: var(--lux-purple-dark, #1A0B2E);">{{ $paginator->firstItem() }}</span> 
                {!! __('to') !!} <span class="fw-bold" style="color: var(--lux-purple-dark, #1A0B2E);">{{ $paginator->lastItem() }}</span> 
                {!! __('of') !!} <span class="fw-bold" style="color: var(--lux-gold, #D4AF37);">{{ $paginator->total() }}</span> {!! __('Results') !!}
            </div>

        </div>
    </nav>
@endif
