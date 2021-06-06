<?php

namespace StudyCli\Output;

use StudyCli\App;
use StudyCli\Output\Adapter\DefaultPrinterAdapter;
use StudyCli\Output\Helper\TableHelper;
use StudyCli\ServiceInterface;

class OutputHandler implements ServiceInterface
{

    protected $printer_adapter;

    protected $output_filters = [];

    public function __construct(PrinterAdapterInterface $printer = null)
    {
        $this->printer_adapter = $printer ?? new DefaultPrinterAdapter();
    }

    public function registerFilter(OutputFilterInterface $filter): void
    {
        $this->output_filters[] = $filter;
    }

    public function clearFilters(): void
    {
        $this->output_filters = [];
    }

    public function load(App $app)
    {
        return true;
    }

    public function filterOutput($content, $style = null): string
    {
        foreach ($this->output_filters as $filter) {
            $content = $filter->filter($content, $style);
        }

        return $content;
    }

    public function out($content, $style = "default"): void
    {
       $this->printer_adapter->out($this->filterOutput($content, $style));
    }

    public function rawOutput($content)
    {
        $this->printer_adapter->out($content);
    }

    public function newline(): void
    {
        $this->rawOutput("\n");
    }

    public function display($content, $alt = false): void
    {
        $this->newline();
        $this->out($content, $alt ? "alt" : "default");
        $this->newline();
    }

    public function error($content, $alt = false): void
    {
        $this->newline();
        $this->out($content, $alt ? "error_alt" : "error");
        $this->newline();
    }

    public function info($content, $alt = false): void
    {
        $this->newline();
        $this->out($content, $alt ? "info_alt" : "info");
        $this->newline();
    }

    public function success($content, $alt = false): void
    {
        $this->newline();
        $this->out($content, $alt ? "success_alt" : "success");
        $this->newline();
    }

    public function printTable(array $table): void
    {
        $helper = new TableHelper($table);

        $filter = (isset($this->output_filters[0]) && $this->output_filters[0] instanceof OutputFilterInterface) ? $this->output_filters[0] : null;
        $this->newline();
        $this->rawOutput($helper->getFormattedTable($filter));
        $this->newline();
    }
}