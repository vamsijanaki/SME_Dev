<div class="dataTables_wrapper ">

    <div class="dataTables_info pagination_info" id="" role="status" aria-live="polite">

        <span>{!! __('Showing') !!}</span>
        <span class="font-medium">{{ $paginator->firstItem() }}</span>
        <span>{!! __('to') !!}</span>
        <span class="font-medium">{{ $paginator->lastItem() }}</span>
        <span>{!! __('of') !!}</span>
        <span class="font-medium">{{ $paginator->total() }}</span>
        <span>{!! __('results') !!}</span>
    </div>
    <div class="dataTables_paginate paging_simple_numbers" id="">

        @if ($paginator->hasPages())
            @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)

            @if ($paginator->onFirstPage())

                <button class="paginate_button previous" type="button"
                        wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                        id="lms_table_previous">
                    <i class="ti-arrow-left"></i>
                </button>
            @else
                <button type="button" class="paginate_button previous"
                        wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                        id="lms_table_previous">
                    <i class="ti-arrow-left"></i>
                </button>
            @endif

            <span>



           @foreach ($elements as $element)
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <button type="button" class="paginate_button  current"
                                        wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}"
                                >
            {{ $page }}
                                </button>
                            @else

                                <button
                                    wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}"
                                    type="button" class="  paginate_button"
                                    wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">
                                        {{ $page }}
                                    </button>



                            @endif
                        @endforeach
                    @endif
                @endforeach
    </span>
            @if ($paginator->hasMorePages())
                <button type="button"
                        class="paginate_button next" class="page-link"
                        wire:click="nextPage('{{ $paginator->getPageName() }}')"
                        wire:loading.attr="disabled"><i
                        class="ti-arrow-right"></i>
                </button>
            @else
                <button type="button"
                        class="paginate_button next"><i
                        class="ti-arrow-right"></i>
                </button>
            @endif
        @endif
    </div>
</div>


