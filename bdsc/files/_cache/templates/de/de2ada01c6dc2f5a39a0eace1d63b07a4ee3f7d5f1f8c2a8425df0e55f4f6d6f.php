<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* pages/assets/printer.html.twig */
class __TwigTemplate_1866b3c18a26fdc6e3cbba4c46e41d76efee3f6c04edaa3aefd70422a4ffd2af extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'more_fields' => [$this, 'block_more_fields'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 34
        return "generic_show_form.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 35
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "pages/assets/printer.html.twig", 35)->unwrap();
        // line 36
        $context["params"] = (($context["params"]) ?? ([]));
        // line 34
        $this->parent = $this->loadTemplate("generic_show_form.html.twig", "pages/assets/printer.html.twig", 34);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 38
    public function block_more_fields($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 39
        yield "    ";
        yield CoreExtension::callMacro($macros["fields"], "macro_numberField", ["memory_size", (($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source,         // line 41
($context["item"] ?? null), "fields", [], "any", false, false, false, 41)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["memory_size"] ?? null) : null), _n("Memory", "Memories", 1),         // line 43
($context["field_options"] ?? null)], 39, $context, $this->getSourceContext());
        // line 44
        yield "

    ";
        // line 46
        yield CoreExtension::callMacro($macros["fields"], "macro_numberField", ["init_pages_counter", (($__internal_compile_1 = CoreExtension::getAttribute($this->env, $this->source,         // line 48
($context["item"] ?? null), "fields", [], "any", false, false, false, 48)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["init_pages_counter"] ?? null) : null), __("Initial page counter"),         // line 50
($context["field_options"] ?? null)], 46, $context, $this->getSourceContext());
        // line 51
        yield "

    ";
        // line 53
        yield CoreExtension::callMacro($macros["fields"], "macro_numberField", ["last_pages_counter", (($__internal_compile_2 = CoreExtension::getAttribute($this->env, $this->source,         // line 55
($context["item"] ?? null), "fields", [], "any", false, false, false, 55)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["last_pages_counter"] ?? null) : null), __("Current counter of pages"),         // line 57
($context["field_options"] ?? null)], 53, $context, $this->getSourceContext());
        // line 58
        yield "

    ";
        // line 60
        $context["flags_html"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 61
            yield "    ";
            yield Twig\Extension\CoreExtension::include($this->env, $context, "components/form/flags.html.twig");
            yield "
    ";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 63
        yield "
    ";
        // line 64
        if (Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::trim(($context["flags_html"] ?? null)))) {
            // line 65
            yield "        ";
            $context["flags_html"] = (("<div class=\"d-flex flex-wrap\">" . ($context["flags_html"] ?? null)) . "</div>");
            // line 66
            yield "        ";
            yield CoreExtension::callMacro($macros["fields"], "macro_htmlField", ["",             // line 68
($context["flags_html"] ?? null), _n("Port", "Ports", Session::getPluralNumber())], 66, $context, $this->getSourceContext());
            // line 70
            yield "
    ";
        }
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "pages/assets/printer.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  102 => 70,  100 => 68,  98 => 66,  95 => 65,  93 => 64,  90 => 63,  83 => 61,  81 => 60,  77 => 58,  75 => 57,  74 => 55,  73 => 53,  69 => 51,  67 => 50,  66 => 48,  65 => 46,  61 => 44,  59 => 43,  58 => 41,  56 => 39,  52 => 38,  47 => 34,  45 => 36,  43 => 35,  36 => 34,);
    }

    public function getSourceContext()
    {
        return new Source("", "pages/assets/printer.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\pages\\assets\\printer.html.twig");
    }
}
