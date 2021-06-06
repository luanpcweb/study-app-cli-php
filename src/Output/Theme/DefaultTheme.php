<?php
namespace StudyCli\Output\Theme;

use StudyCli\Output\CLIColors;
use StudyCli\Output\CLIThemeInterface;

class DefaultTheme implements CLIThemeInterface
{

    public $styles = [];

    public function __construct()
    {
        $styles = array_merge($this->getDefaultColors(), $this->getThemeColors());

        foreach ($styles as $name => $style) {
            $this->setStyle($name, $style);
        }
    }

    public function getStyle(string $name)
    {
        return $this->styles[$name] ?? $this->styles['default'];
    }

    public function setStyle(string $name, array $style): void
    {
        $this->styles[$name] = $style;
    }

    public function getDefaultColors() :array
    {
        return [
            'default'     => [ CLIColors::$FG_WHITE ],
            'alt'         => [ CLIColors::$FG_BLACK, CLIColors::$BG_WHITE ],
            'error'       => [ CLIColors::$FG_RED ],
            'error_alt'   => [ CLIColors::$FG_WHITE, CLIColors::$BG_RED ],
            'success'     => [ CLIColors::$FG_GREEN ],
            'success_alt' => [ CLIColors::$FG_WHITE, CLIColors::$BG_GREEN ],
            'info'        => [ CLIColors::$FG_CYAN],
            'info_alt'    => [ CLIColors::$FG_WHITE, CLIColors::$BG_CYAN ],
            'bold'        => [ CliColors::$BOLD ],
            'dim'         => [ CliColors::$DIM ],
            'italic'      => [ CliColors::$ITALIC ],
            'underline'   => [ CliColors::$UNDERLINE ],
            'invert'      => [ CliColors::$INVERT ]
        ];
    }

    public function getThemeColors(): array
    {
        return [];
    }
}