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

/* components/user/link_with_tooltip.html.twig */
class __TwigTemplate_a29b0736c7242644b7b0c4e47b48f7037c4d488caff667041c325bd67dfd463f extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 33
        yield "
";
        // line 34
        $context["rand"] = Twig\Extension\CoreExtension::random($this->env->getCharset());
        // line 35
        yield "
<span id=\"user_";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand"] ?? null), "html", null, true);
        yield "\">
    <i class=\"ti ti-user ms-1\"></i>
    ";
        // line 38
        yield $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemLink("User", ($context["users_id"] ?? null), ["enable_anonymization" => ($context["enable_anonymization"] ?? null)]);
        yield "
</span>

";
        // line 41
        if ( !($context["enable_anonymization"] ?? null)) {
            // line 42
            yield "    ";
            $context["user"] = (($context["user_object"]) ?? ($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItem("User", ($context["users_id"] ?? null))));
            // line 43
            yield "    ";
            if (( !(null === ($context["user"] ?? null)) && CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "canView", [], "method", false, false, false, 43))) {
                // line 44
                yield "        ";
                $context["user_fields"] = CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "fields", [], "any", false, false, false, 44);
                // line 45
                yield "        ";
                $context["user_fields"] = Twig\Extension\CoreExtension::merge(($context["user_fields"] ?? null), ["user_name" => $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "getFriendlyName", [], "method", false, false, false, 45))]);
                // line 46
                yield "        ";
                $context["user_fields"] = Twig\Extension\CoreExtension::merge(($context["user_fields"] ?? null), ["email" => CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "getDefaultEmail", [], "method", false, false, false, 46)]);
                // line 47
                yield "        ";
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::showToolTip", [Twig\Extension\CoreExtension::include($this->env, $context, "components/user/info_card.html.twig", ["user" =>                 // line 53
($context["user_fields"] ?? null), "user_object" =>                 // line 54
($context["user"] ?? null)], false), ["applyto" => ("user_" .                 // line 59
($context["rand"] ?? null))]]);
                // line 63
                yield "    ";
            }
        }
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/user/link_with_tooltip.html.twig";
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
        return array (  80 => 63,  78 => 59,  77 => 54,  76 => 53,  74 => 47,  71 => 46,  68 => 45,  65 => 44,  62 => 43,  59 => 42,  57 => 41,  51 => 38,  46 => 36,  43 => 35,  41 => 34,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/user/link_with_tooltip.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\user\\link_with_tooltip.html.twig");
    }
}
