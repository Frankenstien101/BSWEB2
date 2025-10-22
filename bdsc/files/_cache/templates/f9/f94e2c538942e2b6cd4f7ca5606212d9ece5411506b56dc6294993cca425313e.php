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

/* @formcreator/pages/targetticket.html.twig */
class __TwigTemplate_4d1c9635521b83fb3f577bd6170bf353b55af47a5cbf5e5f6847df3eaf0c865c extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'form_fields' => [$this, 'block_form_fields'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 31
        return "generic_show_form.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 32
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/pages/targetticket.html.twig", 32)->unwrap();
        // line 31
        $this->parent = $this->loadTemplate("generic_show_form.html.twig", "@formcreator/pages/targetticket.html.twig", 31);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 34
    public function block_form_fields($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 35
        yield "    ";
        yield CoreExtension::callMacro($macros["fields"], "macro_autoNameField", ["name",         // line 37
($context["item"] ?? null), __("Name"),         // line 39
($context["withtemplate"] ?? null), ["required" => true, "full_width" => true]], 35, $context, $this->getSourceContext());
        // line 41
        yield "

    ";
        // line 43
        yield CoreExtension::callMacro($macros["fields"], "macro_smallTitle", [_n("Target ticket", "Target tickets", 1, "formcreator")], 43, $context, $this->getSourceContext());
        yield "

    ";
        // line 45
        yield CoreExtension::callMacro($macros["fields"], "macro_textField", ["target_name", (($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source,         // line 47
($context["item"] ?? null), "fields", [], "any", false, false, false, 47)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["target_name"] ?? null) : null), __("Ticket title", "formcreator"), ["required" => true, "full_width" => true]], 45, $context, $this->getSourceContext());
        // line 50
        yield "

    ";
        // line 52
        yield CoreExtension::callMacro($macros["fields"], "macro_textareaField", ["content", (($__internal_compile_1 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 52)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["content"] ?? null) : null), __("Description", "formcreator"), ["enable_richtext" => true, "full_width" => true]], 52, $context, $this->getSourceContext());
        yield "
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@formcreator/pages/targetticket.html.twig";
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
        return array (  75 => 52,  71 => 50,  69 => 47,  68 => 45,  63 => 43,  59 => 41,  57 => 39,  56 => 37,  54 => 35,  50 => 34,  45 => 31,  43 => 32,  36 => 31,);
    }

    public function getSourceContext()
    {
        return new Source("", "@formcreator/pages/targetticket.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\plugins\\formcreator\\templates\\pages\\targetticket.html.twig");
    }
}
