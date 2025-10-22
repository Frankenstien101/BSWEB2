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

/* components/itilobject/fields/global_validation.html.twig */
class __TwigTemplate_8bb8155c21a164cb8048515c3f20dbf8437b3fb7a8d119505e46b29a9fe48bf6 extends Template
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
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "components/itilobject/fields/global_validation.html.twig", 34)->unwrap();
        // line 35
        yield "
";
        // line 36
        $context["validation"] = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getValidationClassInstance", [], "method", false, false, false, 36);
        // line 37
        yield "
";
        // line 38
        if ( !(null === ($context["validation"] ?? null))) {
            // line 39
            yield "   ";
            $context["create_right_val"] = Twig\Extension\CoreExtension::constant("CREATE");
            // line 40
            yield "   ";
            $context["validation_right"] = "validate";
            // line 41
            yield "   ";
            if ((0 === CoreExtension::compare(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 41), "Ticket"))) {
                // line 42
                yield "      ";
                if ((0 === CoreExtension::compare((($__internal_compile_0 = ($context["params"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["type"] ?? null) : null), Twig\Extension\CoreExtension::constant("Ticket::INCIDENT_TYPE")))) {
                    // line 43
                    yield "         ";
                    $context["create_right_val"] = Twig\Extension\CoreExtension::constant("TicketValidation::CREATEINCIDENT");
                    // line 44
                    yield "         ";
                    $context["validation_right"] = "validate_incident";
                    // line 45
                    yield "      ";
                } elseif ((0 === CoreExtension::compare((($__internal_compile_1 = ($context["params"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["type"] ?? null) : null), Twig\Extension\CoreExtension::constant("Ticket::DEMAND_TYPE")))) {
                    // line 46
                    yield "         ";
                    $context["create_right_val"] = Twig\Extension\CoreExtension::constant("TicketValidation::CREATEREQUEST");
                    // line 47
                    yield "         ";
                    $context["validation_right"] = "validate_request";
                    // line 48
                    yield "      ";
                }
                // line 49
                yield "   ";
            }
            // line 50
            yield "   ";
            $context["can_create"] = Session::haveRight($this->extensions['Glpi\Application\View\Extension\PhpExtension']->getStatic(($context["validation"] ?? null), "rightname"), ($context["create_right_val"] ?? null));
            // line 51
            yield "
   ";
            // line 52
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 52)) {
                // line 53
                yield "      ";
                if (($context["can_create"] ?? null)) {
                    // line 54
                    yield "         ";
                    $context["required"] = [];
                    // line 55
                    yield "         ";
                    if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["field_options"] ?? null), "fields_template", [], "any", false, false, false, 55), "isMandatoryField", ["_add_validation"], "method", false, false, false, 55)) {
                        // line 56
                        yield "            ";
                        $context["required"] = ["required" => true];
                        // line 59
                        yield "         ";
                    }
                    // line 60
                    yield "
         ";
                    // line 61
                    yield CoreExtension::callMacro($macros["fields"], "macro_field", ["_add_validation", CoreExtension::getAttribute($this->env, $this->source,                     // line 63
($context["validation"] ?? null), "dropdownValidator", [Twig\Extension\CoreExtension::merge(["name" => "users_id_validate", "entity" => (($__internal_compile_2 = CoreExtension::getAttribute($this->env, $this->source,                     // line 65
($context["item"] ?? null), "fields", [], "any", false, false, false, 65)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["entities_id"] ?? null) : null), "right" =>                     // line 66
($context["validation_right"] ?? null), "users_id_validate" => (($__internal_compile_3 =                     // line 67
($context["params"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["users_id_validate"] ?? null) : null), "display" => false, "disabled" =>  !                    // line 69
($context["canupdate"] ?? null)],                     // line 70
($context["required"] ?? null))], "method", false, false, false, 63), __("Approval request"),                     // line 72
($context["field_options"] ?? null)], 61, $context, $this->getSourceContext());
                    // line 73
                    yield "

         <input type=\"hidden\" name=\"_add_validation\" value=\"";
                    // line 75
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_4 = ($context["params"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["_add_validation"] ?? null) : null), "html", null, true);
                    yield "\" />
      ";
                }
                // line 77
                yield "   ";
            } else {
                // line 78
                yield "        ";
                if ( !CoreExtension::getAttribute($this->env, $this->source, ($context["itiltemplate"] ?? null), "isHiddenField", ["global_validation"], "method", false, false, false, 78)) {
                    // line 79
                    yield "            ";
                    yield CoreExtension::callMacro($macros["fields"], "macro_htmlField", ["global_validation", $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("TicketValidation::getStatus", [(($__internal_compile_5 = CoreExtension::getAttribute($this->env, $this->source,                     // line 81
($context["item"] ?? null), "fields", [], "any", false, false, false, 81)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["global_validation"] ?? null) : null), true]), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("CommonITILValidation"),                     // line 83
($context["field_options"] ?? null)], 79, $context, $this->getSourceContext());
                    // line 84
                    yield "
        ";
                }
                // line 86
                yield "   ";
            }
        }
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/itilobject/fields/global_validation.html.twig";
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
        return array (  145 => 86,  141 => 84,  139 => 83,  138 => 81,  136 => 79,  133 => 78,  130 => 77,  125 => 75,  121 => 73,  119 => 72,  118 => 70,  117 => 69,  116 => 67,  115 => 66,  114 => 65,  113 => 63,  112 => 61,  109 => 60,  106 => 59,  103 => 56,  100 => 55,  97 => 54,  94 => 53,  92 => 52,  89 => 51,  86 => 50,  83 => 49,  80 => 48,  77 => 47,  74 => 46,  71 => 45,  68 => 44,  65 => 43,  62 => 42,  59 => 41,  56 => 40,  53 => 39,  51 => 38,  48 => 37,  46 => 36,  43 => 35,  41 => 34,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/fields/global_validation.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\itilobject\\fields\\global_validation.html.twig");
    }
}
