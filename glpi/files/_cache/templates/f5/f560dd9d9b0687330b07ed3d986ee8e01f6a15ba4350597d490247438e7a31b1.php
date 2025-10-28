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

/* components/itilobject/timeline/simple_form.html.twig */
class __TwigTemplate_5a15e0689c9bf415a881da0b46a40d01ecec8ad8da3c0b927e027fa383f069a0 extends Template
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
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "components/itilobject/timeline/simple_form.html.twig", 34)->unwrap();
        // line 35
        yield "
";
        // line 36
        $context["target"] = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getFormURL", [], "method", false, false, false, 36);
        // line 37
        $context["is_new_item"] = (0 === CoreExtension::compare((($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 37)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["id"] ?? null) : null), 0));
        // line 38
        $context["show_form"] = ( !array_key_exists("no_form", $context) || true);
        // line 39
        yield "
";
        // line 40
        $context["field_options"] = ["is_horizontal" => false, "full_width" => true, "fields_template" =>         // line 43
($context["itiltemplate"] ?? null), "disabled" =>  !(        // line 44
($context["canupdate"] ?? null) || ($context["can_requester"] ?? null))];
        // line 46
        yield "
";
        // line 47
        if (($context["show_form"] ?? null)) {
            // line 48
            yield "<form method=\"post\" action=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["target"] ?? null), "html", null, true);
            yield "\" ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["formoptions"] ?? null), "html", null, true);
            yield " enctype=\"multipart/form-data\" data-submit-once>
";
        }
        // line 50
        yield "   <div class=\"row flex-column\">
      ";
        // line 51
        if ( !CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 51)) {
            // line 52
            yield "        ";
            $context["recipient"] = (((1 === CoreExtension::compare((($__internal_compile_1 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 52)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["users_id_recipient"] ?? null) : null), 0))) ? ((($__internal_compile_2 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 52)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["users_id_recipient"] ?? null) : null)) : ($this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiID")));
            // line 53
            yield "        ";
            yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["User", "users_id_recipient",             // line 56
($context["recipient"] ?? null), __("By"), Twig\Extension\CoreExtension::merge(            // line 58
($context["field_options"] ?? null), ["maxlength" => 255, "entity" => (($__internal_compile_3 = CoreExtension::getAttribute($this->env, $this->source,             // line 60
($context["item"] ?? null), "fields", [], "any", false, false, false, 60)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["entities_id"] ?? null) : null), "right" => "all"])], 53, $context, $this->getSourceContext());
            // line 63
            yield "
      ";
        }
        // line 65
        yield "
      ";
        // line 66
        yield CoreExtension::callMacro($macros["fields"], "macro_textField", ["name", (($__internal_compile_4 = CoreExtension::getAttribute($this->env, $this->source,         // line 68
($context["item"] ?? null), "fields", [], "any", false, false, false, 68)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["name"] ?? null) : null), __("Title"), Twig\Extension\CoreExtension::merge(        // line 70
($context["field_options"] ?? null), ["maxlength" => 255])], 66, $context, $this->getSourceContext());
        // line 73
        yield "

      ";
        // line 75
        $context["uploads"] = [];
        // line 76
        yield "      ";
        if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "input", [], "any", false, true, false, 76), "_content", [], "any", true, true, false, 76)) {
            // line 77
            yield "         ";
            $context["uploads"] = Twig\Extension\CoreExtension::merge(($context["uploads"] ?? null), ["_content" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "input", [], "any", false, false, false, 77), "_content", [], "any", false, false, false, 77), "_tag_content" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "input", [], "any", false, false, false, 77), "_tag_content", [], "any", false, false, false, 77)]);
            // line 78
            yield "      ";
        }
        // line 79
        yield "      ";
        if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "input", [], "any", false, true, false, 79), "_filename", [], "any", true, true, false, 79)) {
            // line 80
            yield "         ";
            $context["uploads"] = Twig\Extension\CoreExtension::merge(($context["uploads"] ?? null), ["_filename" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "input", [], "any", false, false, false, 80), "_filename", [], "any", false, false, false, 80), "_tag_filename" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "input", [], "any", false, false, false, 80), "_tag_filename", [], "any", false, false, false, 80)]);
            // line 81
            yield "      ";
        }
        // line 82
        yield "
      ";
        // line 83
        yield CoreExtension::callMacro($macros["fields"], "macro_textareaField", ["content", (($__internal_compile_5 = CoreExtension::getAttribute($this->env, $this->source,         // line 85
($context["item"] ?? null), "fields", [], "any", false, false, false, 85)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["content"] ?? null) : null), __("Description"), Twig\Extension\CoreExtension::merge(        // line 87
($context["field_options"] ?? null), ["enable_richtext" => true, "enable_fileupload" => true, "enable_mentions" => true, "enable_fileupload" => ((CoreExtension::getAttribute($this->env, $this->source,         // line 91
($context["itiltemplate"] ?? null), "isHiddenField", ["_documents_id"], "method", false, false, false, 91)) ? (false) : (true)), "entities_id" => ((CoreExtension::getAttribute($this->env, $this->source,         // line 92
($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 92)) ? (($context["entities_id"] ?? null)) : ((($__internal_compile_6 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 92)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["entities_id"] ?? null) : null))), "uploads" =>         // line 93
($context["uploads"] ?? null), "add_field_class" => "col-12 itil-textarea-content"])], 83, $context, $this->getSourceContext());
        // line 96
        yield "
   </div>

   ";
        // line 99
        if ((( !($context["is_new_item"] ?? null) && ($context["show_form"] ?? null)) &&  !(($__internal_compile_7 = ($context["params"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["template_preview"] ?? null) : null))) {
            // line 100
            yield "      <div class=\"d-flex card-footer mx-n3 mb-n3\">
         <button class=\"btn btn-primary me-2\" type=\"submit\" name=\"update\">
            <i class=\"far fa-save\"></i>
            <span>";
            // line 103
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_x("button", "Save"), "html", null, true);
            yield "</span>
         </button>
      </div>

      <input type=\"hidden\" name=\"id\" value=\"";
            // line 107
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_8 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 107)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["id"] ?? null) : null), "html", null, true);
            yield "\" />
      <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
            // line 108
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Session::getNewCSRFToken(), "html", null, true);
            yield "\" />
   </form>
   ";
        }
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "components/itilobject/timeline/simple_form.html.twig";
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
        return array (  154 => 108,  150 => 107,  143 => 103,  138 => 100,  136 => 99,  131 => 96,  129 => 93,  128 => 92,  127 => 91,  126 => 87,  125 => 85,  124 => 83,  121 => 82,  118 => 81,  115 => 80,  112 => 79,  109 => 78,  106 => 77,  103 => 76,  101 => 75,  97 => 73,  95 => 70,  94 => 68,  93 => 66,  90 => 65,  86 => 63,  84 => 60,  83 => 58,  82 => 56,  80 => 53,  77 => 52,  75 => 51,  72 => 50,  64 => 48,  62 => 47,  59 => 46,  57 => 44,  56 => 43,  55 => 40,  52 => 39,  50 => 38,  48 => 37,  46 => 36,  43 => 35,  41 => 34,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/timeline/simple_form.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\templates\\components\\itilobject\\timeline\\simple_form.html.twig");
    }
}
