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

/* @formcreator/pages/userform.html.twig */
class __TwigTemplate_64297abc4a3ca8ce26a73b3fab5161dd5817b59a9c063f66a7fb18e0ac251555 extends Template
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
        // line 30
        yield "
";
        // line 31
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/pages/userform.html.twig", 31)->unwrap();
        // line 32
        yield "
<style>
\t";
        // line 34
        $context["widthPercent"] = (100 / CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "columns", [], "any", false, false, false, 34));
        // line 35
        yield "\t";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(range(1, CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "columns", [], "any", false, false, false, 35)));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 36
            yield "\t\t";
            $context["width"] = ($context["i"] * ($context["widthPercent"] ?? null));
            // line 37
            yield "            #plugin_formcreator_form.plugin_formcreator_form [data-itemtype = \"PluginFormcreatorQuestion\"][gs-w=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
            yield "\"],
            #plugin_formcreator_form.plugin_formcreator_form .plugin_formcreator_gap[gs-w=\"";
            // line 38
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["i"], "html", null, true);
            yield "\"] {
                min-width: ";
            // line 39
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["widthPercent"] ?? null), "html", null, true);
            yield "%;
                width: ";
            // line 40
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["width"] ?? null), "html", null, true);
            yield "%;
                margin-left: -0.25em;
            }
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        yield "</style>

<div class=\"asset\">
    ";
        // line 47
        $context["formName"] = "plugin_formcreator_form";
        // line 48
        yield "\t<form name=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["formName"] ?? null), "html", null, true);
        yield "\" method=\"post\" role=\"form\" enctype=\"multipart/form-data\" class=\"plugin_formcreator_form\" onsubmit=\"return plugin_formcreator.submitUserForm(event)\" onkeypress=\"return plugin_formcreator.submitUserFormByKeyPress(event);\" id=\"plugin_formcreator_form\" data-itemtype=\"PluginFormcreatorForm\" data-id=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 48)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["id"] ?? null) : null), "html", null, true);
        yield "\" data-submit-once=\"true\">
\t\t<h1 class='form-title'>
\t\t        ";
        // line 50
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Glpi\\Toolbox\\Sanitizer::unsanitize", [__((($__internal_compile_1 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 50)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["name"] ?? null) : null), CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "domain", [], "any", false, false, false, 50))]), "html", null, true);
        yield "
\t\t\t<i class=\"fas fa-print\" style=\"cursor: pointer;\" onclick=\"window.print();\"></i>
\t\t</h1>
        ";
        // line 53
        if (((0 !== CoreExtension::compare((($__internal_compile_2 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 53)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["content"] ?? null) : null), "")) || (0 !== CoreExtension::compare(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getExtraHeader", [], "method", false, false, false, 53), "")))) {
            // line 54
            yield "            <div class=\"form_header\">
            ";
            // line 55
            yield $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getSafeHtml(__((($__internal_compile_3 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 55)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["content"] ?? null) : null), CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "domain", [], "any", false, false, false, 55)));
            yield "
            ";
            // line 56
            yield $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getSafeHtml(CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "getExtraHeader", [], "method", false, false, false, 56));
            yield "
            </div>
        ";
        }
        // line 59
        yield "        <ol>
        ";
        // line 60
        $context["sections"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PluginFormcreatorSection::getSectionsFromForm", [(($__internal_compile_4 = CoreExtension::getAttribute($this->env, $this->source,         // line 61
($context["item"] ?? null), "fields", [], "any", false, false, false, 61)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["id"] ?? null) : null)]);
        // line 63
        yield "        ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["sections"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["section"]) {
            // line 64
            yield "            ";
            $context["sectionId"] = (($__internal_compile_5 = CoreExtension::getAttribute($this->env, $this->source, $context["section"], "fields", [], "any", false, false, false, 64)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["id"] ?? null) : null);
            // line 65
            yield "            <li class=\"card plugin_formcreator_section\" data-itemtype=\"PluginFormcreatorSection\" data-id=";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["sectionId"] ?? null), "html", null, true);
            yield ">
                <div class=\"card-header\">
                    <h2 class=\"card-title\">
                        ";
            // line 68
            if ((0 === CoreExtension::compare((($__internal_compile_6 = CoreExtension::getAttribute($this->env, $this->source, $context["section"], "fields", [], "any", false, false, false, 68)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["name"] ?? null) : null), ""))) {
                // line 69
                yield "                            (";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["sectionId"] ?? null), "html", null, true);
                yield ")
                        ";
            } else {
                // line 71
                yield "                            ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Glpi\\Toolbox\\Sanitizer::unsanitize", [__((($__internal_compile_7 = CoreExtension::getAttribute($this->env, $this->source, $context["section"], "fields", [], "any", false, false, false, 71)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["name"] ?? null) : null), CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "domain", [], "any", false, false, false, 71))]), "html", null, true);
                yield "
                        ";
            }
            // line 73
            yield "                    </h2>
                </div>
                <div class=\"card-body\">
                    ";
            // line 76
            $context["lastQuestion"] = null;
            // line 77
            yield "                    ";
            $context["questions"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PluginFormcreatorQuestion::getQuestionsFromSection", [            // line 78
($context["sectionId"] ?? null)]);
            // line 80
            yield "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["questions"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["question"]) {
                // line 81
                yield "                        ";
                if ( !(null === ($context["lastQuestion"] ?? null))) {
                    // line 82
                    yield "                            ";
                    if ((-1 === CoreExtension::compare((($__internal_compile_8 = CoreExtension::getAttribute($this->env, $this->source, ($context["lastQuestion"] ?? null), "fields", [], "any", false, false, false, 82)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["row"] ?? null) : null), (($__internal_compile_9 = CoreExtension::getAttribute($this->env, $this->source, $context["question"], "fields", [], "any", false, false, false, 82)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["row"] ?? null) : null)))) {
                        // line 83
                        yield "                                <div class=\"plugin_formcreator_newRow\"></div>
                                ";
                        // line 84
                        if ((1 === CoreExtension::compare((($__internal_compile_10 = CoreExtension::getAttribute($this->env, $this->source, $context["question"], "fields", [], "any", false, false, false, 84)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["col"] ?? null) : null), 0))) {
                            // line 85
                            yield "                                    ";
                            // line 86
                            yield "                                    ";
                            $context["x"] = 0;
                            // line 87
                            yield "                                    ";
                            $context["width"] = (($__internal_compile_11 = CoreExtension::getAttribute($this->env, $this->source, $context["question"], "fields", [], "any", false, false, false, 87)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["col"] ?? null) : null);
                            // line 88
                            yield "                                    <div class=\"plugin_formcreator_gap\" gs-x=\"";
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["x"] ?? null), "html", null, true);
                            yield "\" gs-w=\"";
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["width"] ?? null), "html", null, true);
                            yield "\"></div>
                                ";
                        }
                        // line 90
                        yield "                            ";
                    } else {
                        // line 91
                        yield "                                ";
                        $context["x"] = ((($__internal_compile_12 = CoreExtension::getAttribute($this->env, $this->source, ($context["lastQuestion"] ?? null), "fields", [], "any", false, false, false, 91)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["col"] ?? null) : null) + (($__internal_compile_13 = CoreExtension::getAttribute($this->env, $this->source, ($context["lastQuestion"] ?? null), "fields", [], "any", false, false, false, 91)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["width"] ?? null) : null));
                        // line 92
                        yield "                                ";
                        $context["width"] = ((($__internal_compile_14 = CoreExtension::getAttribute($this->env, $this->source, $context["question"], "fields", [], "any", false, false, false, 92)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["col"] ?? null) : null) - ($context["x"] ?? null));
                        // line 93
                        yield "                                ";
                        if ((-1 === CoreExtension::compare(($context["x"] ?? null), (($__internal_compile_15 = CoreExtension::getAttribute($this->env, $this->source, $context["question"], "fields", [], "any", false, false, false, 93)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["col"] ?? null) : null)))) {
                            // line 94
                            yield "                                    ";
                            // line 95
                            yield "                                    <div class=\"plugin_formcreator_gap\" gs-x=\"";
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["x"] ?? null), "html", null, true);
                            yield "\" gs-w=\"";
                            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["width"] ?? null), "html", null, true);
                            yield "\"></div>
                                ";
                        }
                        // line 97
                        yield "                            ";
                    }
                    // line 98
                    yield "                        ";
                }
                // line 99
                yield "                        ";
                if (( !CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "public", [], "any", false, false, false, 99) || CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["question"], "getSubField", [], "method", false, false, false, 99), "isPublicFormCompatible", [], "method", false, false, false, 99))) {
                    // line 100
                    yield "                            ";
                    $context["sessionData"] = $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("formcreator");
                    // line 101
                    yield "                            ";
                    yield CoreExtension::getAttribute($this->env, $this->source, $context["question"], "getRenderedHtml", [CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "domain", [], "any", false, false, false, 101), true, CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "formanswer", [], "any", false, false, false, 101)], "method", false, false, false, 101);
                    yield "
                        ";
                }
                // line 103
                yield "                        ";
                $context["lastQuestion"] = $context["question"];
                // line 104
                yield "                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['question'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 105
            yield "                </div>
            </li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['section'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 108
        yield "        ";
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "use_captcha", [], "any", false, false, false, 108)) {
            // line 109
            yield "            ";
            $context["captchaTime"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("time");
            // line 110
            yield "            ";
            $context["catchaId"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("md5", [(($context["captchaTime"] ?? null) . (($__internal_compile_16 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 110)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["id"] ?? null) : null))]);
            // line 111
            yield "            ";
            $context["captcha"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PluginFormcreatorCommon::getCaptcha", [($context["captchaId"] ?? null)]);
            // line 112
            yield "            <li class=\"plugin_formcreator_section\" id=\"plugin_formcreator_captcha_section\">
                <div class=\"card-header\">";
            // line 113
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Are you a robot ?", "formcreator"), "html", null, true);
            yield "</div>
                <div class=\"card-body\"><label for=\"plugin_formcreator_captcha\">";
            // line 114
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Are you a robot ?", "formcreator"), "html", null, true);
            yield "</label>
                    <div><i onclick=\"plugin_formcreator_refreshCaptcha()\" class=\"fas fa-sync-alt\"></i>&nbsp;<img src=\"";
            // line 115
            yield (($__internal_compile_17 = ($context["captcha"] ?? null)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["img"] ?? null) : null);
            yield "\">
                        <div style=\"width: 50%; float: right\" class=\"form_field\"><span class=\"no-wrap\">
                        ";
            // line 117
            yield CoreExtension::callMacro($macros["fields"], "macro_textField", ["plugin_formcreator_captcha", "", "", ["no_label" => true]], 117, $context, $this->getSourceContext());
            yield "
                        ";
            // line 118
            yield CoreExtension::callMacro($macros["fields"], "macro_hiddenField", ["plugin_formcreator_captcha_id", ($context["captchaId"] ?? null)], 118, $context, $this->getSourceContext());
            yield "
                        </div>
                    </div>
                </div>
            </li>
        ";
        }
        // line 124
        yield "        </ol>
        <script>
           \$(
              function() {
                 plugin_formcreator.showFields(\$(\"form[name='";
        // line 128
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["formName"] ?? null), "html", null, true);
        yield "']\"));
              }
           )
        </script>

        ";
        // line 133
        yield $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PluginFormcreatorForm_Validator::dropdownValidator", [        // line 134
($context["item"] ?? null)]);
        // line 135
        yield "

        <div class=\"center\">
          ";
        // line 138
        yield $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::submit", [__("Send"), ["name" => "add"]]);
        // line 141
        yield "
        </div>
        ";
        // line 143
        yield CoreExtension::callMacro($macros["fields"], "macro_hiddenField", ["plugin_formcreator_forms_id", (($__internal_compile_18 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 143)) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["id"] ?? null) : null)], 143, $context, $this->getSourceContext());
        yield "
        <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
        // line 144
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Session::getNewCSRFToken(), "html", null, true);
        yield "\" />
\t</form>
</div>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@formcreator/pages/userform.html.twig";
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
        return array (  324 => 144,  320 => 143,  316 => 141,  314 => 138,  309 => 135,  307 => 134,  306 => 133,  298 => 128,  292 => 124,  283 => 118,  279 => 117,  274 => 115,  270 => 114,  266 => 113,  263 => 112,  260 => 111,  257 => 110,  254 => 109,  251 => 108,  243 => 105,  237 => 104,  234 => 103,  228 => 101,  225 => 100,  222 => 99,  219 => 98,  216 => 97,  208 => 95,  206 => 94,  203 => 93,  200 => 92,  197 => 91,  194 => 90,  186 => 88,  183 => 87,  180 => 86,  178 => 85,  176 => 84,  173 => 83,  170 => 82,  167 => 81,  162 => 80,  160 => 78,  158 => 77,  156 => 76,  151 => 73,  145 => 71,  139 => 69,  137 => 68,  130 => 65,  127 => 64,  122 => 63,  120 => 61,  119 => 60,  116 => 59,  110 => 56,  106 => 55,  103 => 54,  101 => 53,  95 => 50,  87 => 48,  85 => 47,  80 => 44,  70 => 40,  66 => 39,  62 => 38,  57 => 37,  54 => 36,  49 => 35,  47 => 34,  43 => 32,  41 => 31,  38 => 30,);
    }

    public function getSourceContext()
    {
        return new Source("", "@formcreator/pages/userform.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\plugins\\formcreator\\templates\\pages\\userform.html.twig");
    }
}
