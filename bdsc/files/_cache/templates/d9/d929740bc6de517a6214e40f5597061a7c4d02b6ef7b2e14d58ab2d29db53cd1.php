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

/* @formcreator/components/form/fields_macros.html.twig */
class __TwigTemplate_10fe5aa252caf5085219aaf73a9e2530f69c4e59b5ddb057d5253c0033056516 extends Template
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
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/components/form/fields_macros.html.twig", 30)->unwrap();
        // line 31
        yield "
";
        // line 63
        yield "
";
        // line 86
        yield "
";
        // line 109
        yield "
";
        // line 132
        yield "
";
        // line 155
        yield "
";
        // line 178
        yield "
";
        // line 200
        yield "
";
        // line 222
        yield "
";
        // line 242
        yield "
";
        // line 262
        yield "
";
        // line 284
        yield "
";
        // line 305
        yield "
";
        return; yield '';
    }

    // line 32
    public function macro_dropdownQuestionType($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 33
            yield "   ";
            $macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/components/form/fields_macros.html.twig", 33)->unwrap();
            // line 34
            yield "
   ";
            // line 35
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "multiple", [], "any", false, false, false, 35)) {
                // line 36
                yield "      ";
                // line 37
                yield "      ";
                $context["defined_input_name"] = (("_" . ($context["name"] ?? null)) . "_defined");
                // line 38
                yield "      <input type=\"hidden\" name=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["defined_input_name"] ?? null), "html", null, true);
                yield "\" value=\"1\"></input>

      ";
                // line 41
                yield "      ";
                $context["name"] = (($context["name"] ?? null) . "[]");
                // line 42
                yield "   ";
            }
            // line 43
            yield "   ";
            $context["options"] = Twig\Extension\CoreExtension::merge(["rand" => Twig\Extension\CoreExtension::random($this->env->getCharset())], ($context["options"] ?? null));
            // line 44
            yield "   ";
            if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 44), "isMandatoryField", [($context["name"] ?? null)], "method", false, false, false, 44)) {
                // line 45
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(["specific_tags" => ["required" => true]], ($context["options"] ?? null));
                // line 46
                yield "   ";
            }
            // line 47
            yield "
   ";
            // line 48
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 48)) {
                // line 49
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(($context["options"] ?? null), ["specific_tags" => ["disabled" => "disabled"]]);
                // line 50
                yield "   ";
            }
            // line 51
            yield "
   ";
            // line 52
            $context["field"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 53
                yield "      ";
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PluginFormcreatorQuestion::dropdownQuestionType", [($context["name"] ?? null), Twig\Extension\CoreExtension::merge(["value" =>                 // line 54
($context["value"] ?? null), "rand" =>                 // line 55
($context["rand"] ?? null), "width" => "100%"],                 // line 57
($context["options"] ?? null))]);
                // line 58
                yield "   ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 59
            yield "   ";
            if ( !Twig\Extension\CoreExtension::testEmpty(Twig\Extension\CoreExtension::trim(($context["field"] ?? null)))) {
                // line 60
                yield "      ";
                yield CoreExtension::callMacro($macros["fields"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), Twig\Extension\CoreExtension::merge(($context["options"] ?? null), ["id" => ((("dropdown_" . ($context["name"] ?? null)) . "_") . CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 60))])], 60, $context, $this->getSourceContext());
                yield "
   ";
            }
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 64
    public function macro_dropdownDropdownSubType($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 65
            yield "   ";
            $macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/components/form/fields_macros.html.twig", 65)->unwrap();
            // line 66
            yield "
   ";
            // line 67
            $context["options"] = Twig\Extension\CoreExtension::merge(["rand" => Twig\Extension\CoreExtension::random($this->env->getCharset())], ($context["options"] ?? null));
            // line 68
            yield "
   ";
            // line 69
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 69)) {
                // line 70
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(($context["options"] ?? null), ["specific_tags" => ["disabled" => "disabled"]]);
                // line 71
                yield "   ";
            }
            // line 72
            yield "   ";
            if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 72), "isMandatoryField", [($context["name"] ?? null)], "method", false, false, false, 72)) {
                // line 73
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(["specific_tags" => ["required" => true]], ($context["options"] ?? null));
                // line 74
                yield "   ";
            }
            // line 75
            yield "
   ";
            // line 76
            $context["field"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 77
                yield "      ";
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PluginFormcreatorQuestion::dropdownDropdownSubType", [($context["name"] ?? null), Twig\Extension\CoreExtension::merge(["value" =>                 // line 78
($context["value"] ?? null), "rand" =>                 // line 79
($context["rand"] ?? null), "width" => "100%"],                 // line 81
($context["options"] ?? null))]);
                // line 82
                yield "   ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 83
            yield "
   ";
            // line 84
            yield CoreExtension::callMacro($macros["fields"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), Twig\Extension\CoreExtension::merge(($context["options"] ?? null), ["id" => ((("dropdown_" . ($context["name"] ?? null)) . "_") . CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 84))])], 84, $context, $this->getSourceContext());
            yield "
";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 87
    public function macro_dropdownObjectSubType($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 88
            yield "   ";
            $macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/components/form/fields_macros.html.twig", 88)->unwrap();
            // line 89
            yield "
   ";
            // line 90
            $context["options"] = Twig\Extension\CoreExtension::merge(["rand" => Twig\Extension\CoreExtension::random($this->env->getCharset())], ($context["options"] ?? null));
            // line 91
            yield "
   ";
            // line 92
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 92)) {
                // line 93
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(($context["options"] ?? null), ["specific_tags" => ["disabled" => "disabled"]]);
                // line 94
                yield "   ";
            }
            // line 95
            yield "   ";
            if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 95), "isMandatoryField", [($context["name"] ?? null)], "method", false, false, false, 95)) {
                // line 96
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(["specific_tags" => ["required" => true]], ($context["options"] ?? null));
                // line 97
                yield "   ";
            }
            // line 98
            yield "
   ";
            // line 99
            $context["field"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 100
                yield "      ";
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PluginFormcreatorQuestion::dropdownObjectSubType", [($context["name"] ?? null), Twig\Extension\CoreExtension::merge(["value" =>                 // line 101
($context["value"] ?? null), "rand" =>                 // line 102
($context["rand"] ?? null), "width" => "100%"],                 // line 104
($context["options"] ?? null))]);
                // line 105
                yield "   ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 106
            yield "
   ";
            // line 107
            yield CoreExtension::callMacro($macros["fields"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), Twig\Extension\CoreExtension::merge(($context["options"] ?? null), ["id" => ((("dropdown_" . ($context["name"] ?? null)) . "_") . CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 107))])], 107, $context, $this->getSourceContext());
            yield "
";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 110
    public function macro_dropdownEntityRestrict($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 111
            yield "   ";
            $macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/components/form/fields_macros.html.twig", 111)->unwrap();
            // line 112
            yield "
   ";
            // line 113
            $context["options"] = Twig\Extension\CoreExtension::merge(["rand" => Twig\Extension\CoreExtension::random($this->env->getCharset())], ($context["options"] ?? null));
            // line 114
            yield "
   ";
            // line 115
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 115)) {
                // line 116
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(($context["options"] ?? null), ["specific_tags" => ["disabled" => "disabled"]]);
                // line 117
                yield "   ";
            }
            // line 118
            yield "   ";
            if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 118), "isMandatoryField", [($context["name"] ?? null)], "method", false, false, false, 118)) {
                // line 119
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(["specific_tags" => ["required" => true]], ($context["options"] ?? null));
                // line 120
                yield "   ";
            }
            // line 121
            yield "
   ";
            // line 122
            $context["field"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 123
                yield "      ";
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("\\GlpiPlugin\\Formcreator\\Filter\\EntityFilter::dropdown", [($context["name"] ?? null), Twig\Extension\CoreExtension::merge(["value" =>                 // line 124
($context["value"] ?? null), "rand" =>                 // line 125
($context["rand"] ?? null), "width" => "100%"],                 // line 127
($context["options"] ?? null))]);
                // line 128
                yield "   ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 129
            yield "
   ";
            // line 130
            yield CoreExtension::callMacro($macros["fields"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), Twig\Extension\CoreExtension::merge(($context["options"] ?? null), ["id" => ((("dropdown_" . ($context["name"] ?? null)) . "_") . CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 130))])], 130, $context, $this->getSourceContext());
            yield "
";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 133
    public function macro_dropdownItilCategoryFilter($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 134
            yield "   ";
            $macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/components/form/fields_macros.html.twig", 134)->unwrap();
            // line 135
            yield "
   ";
            // line 136
            $context["options"] = Twig\Extension\CoreExtension::merge(["rand" => Twig\Extension\CoreExtension::random($this->env->getCharset())], ($context["options"] ?? null));
            // line 137
            yield "
   ";
            // line 138
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 138)) {
                // line 139
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(($context["options"] ?? null), ["specific_tags" => ["disabled" => "disabled"]]);
                // line 140
                yield "   ";
            }
            // line 141
            yield "   ";
            if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 141), "isMandatoryField", [($context["name"] ?? null)], "method", false, false, false, 141)) {
                // line 142
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(["specific_tags" => ["required" => true]], ($context["options"] ?? null));
                // line 143
                yield "   ";
            }
            // line 144
            yield "
   ";
            // line 145
            $context["field"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 146
                yield "      ";
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("\\GlpiPlugin\\Formcreator\\Filter\\ItilCategoryFilter::dropdown", [($context["name"] ?? null), Twig\Extension\CoreExtension::merge(["value" =>                 // line 147
($context["value"] ?? null), "rand" =>                 // line 148
($context["rand"] ?? null), "width" => "100%"],                 // line 150
($context["options"] ?? null))]);
                // line 151
                yield "   ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 152
            yield "
   ";
            // line 153
            yield CoreExtension::callMacro($macros["fields"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), Twig\Extension\CoreExtension::merge(($context["options"] ?? null), ["id" => ((("dropdown_" . ($context["name"] ?? null)) . "_") . CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 153))])], 153, $context, $this->getSourceContext());
            yield "
";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 156
    public function macro_rangeField($__name__ = null, $__min__ = null, $__max__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "min" => $__min__,
            "max" => $__max__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 157
            yield "    ";
            $macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/components/form/fields_macros.html.twig", 157)->unwrap();
            // line 158
            yield "    ";
            if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 158), "isMandatoryField", [($context["name"] ?? null)], "method", false, false, false, 158)) {
                // line 159
                yield "        ";
                $context["options"] = Twig\Extension\CoreExtension::merge(["required" => true], ($context["options"] ?? null));
                // line 160
                yield "    ";
            }
            // line 161
            yield "
    ";
            // line 162
            $context["field"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 163
                yield "        <input type=\"number\" id=\"range_min\"
                class=\"form-control\"
                name=\"";
                // line 165
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["name"] ?? null), "html", null, true);
                yield "[min]\" value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["min"] ?? null), "html", null, true);
                yield "\"
            ";
                // line 166
                yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "readonly", [], "any", false, false, false, 166)) ? ("readonly") : (""));
                yield "
            ";
                // line 167
                yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 167)) ? ("disabled") : (""));
                yield "
            ";
                // line 168
                yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "required", [], "any", false, false, false, 168)) ? ("required") : (""));
                yield " />
        <input type=\"number\" id=\"range_max\"
                class=\"form-control\"
                name=\"";
                // line 171
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["name"] ?? null), "html", null, true);
                yield "[max]\" value=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["max"] ?? null), "html", null, true);
                yield "\"
            ";
                // line 172
                yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "readonly", [], "any", false, false, false, 172)) ? ("readonly") : (""));
                yield "
            ";
                // line 173
                yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 173)) ? ("disabled") : (""));
                yield "
            ";
                // line 174
                yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "required", [], "any", false, false, false, 174)) ? ("required") : (""));
                yield " />
        ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 176
            yield "        ";
            yield CoreExtension::callMacro($macros["fields"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 176, $context, $this->getSourceContext());
            yield "
";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 179
    public function macro_dropdownLanguageField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 180
            yield "   ";
            $macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/components/form/fields_macros.html.twig", 180)->unwrap();
            // line 181
            yield "   ";
            $context["options"] = Twig\Extension\CoreExtension::merge(["rand" => Twig\Extension\CoreExtension::random($this->env->getCharset())], ($context["options"] ?? null));
            // line 182
            yield "
   ";
            // line 183
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 183)) {
                // line 184
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(($context["options"] ?? null), ["specific_tags" => ["disabled" => "disabled"]]);
                // line 185
                yield "   ";
            }
            // line 186
            yield "   ";
            if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 186), "isMandatoryField", [($context["name"] ?? null)], "method", false, false, false, 186)) {
                // line 187
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(["specific_tags" => ["required" => true]], ($context["options"] ?? null));
                // line 188
                yield "   ";
            }
            // line 189
            yield "
   ";
            // line 190
            $context["field"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 191
                yield "      ";
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Dropdown::showLanguages", [($context["name"] ?? null), Twig\Extension\CoreExtension::merge(["value" =>                 // line 192
($context["value"] ?? null), "rand" =>                 // line 193
($context["rand"] ?? null), "width" => "100%"],                 // line 195
($context["options"] ?? null))]);
                // line 196
                yield "   ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 197
            yield "
   ";
            // line 198
            yield CoreExtension::callMacro($macros["fields"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), Twig\Extension\CoreExtension::merge(($context["options"] ?? null), ["id" => ((("dropdown_" . ($context["name"] ?? null)) . "_") . CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 198))])], 198, $context, $this->getSourceContext());
            yield "
";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 201
    public function macro_dropdownFontAwesomeIconField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 202
            yield "   ";
            $macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/components/form/fields_macros.html.twig", 202)->unwrap();
            // line 203
            yield "   ";
            $context["options"] = Twig\Extension\CoreExtension::merge(["rand" => Twig\Extension\CoreExtension::random($this->env->getCharset())], ($context["options"] ?? null));
            // line 204
            yield "
   ";
            // line 205
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 205)) {
                // line 206
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(($context["options"] ?? null), ["specific_tags" => ["disabled" => "disabled"]]);
                // line 207
                yield "   ";
            }
            // line 208
            yield "   ";
            if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 208), "isMandatoryField", [($context["name"] ?? null)], "method", false, false, false, 208)) {
                // line 209
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(["specific_tags" => ["required" => true]], ($context["options"] ?? null));
                // line 210
                yield "   ";
            }
            // line 211
            yield "
   ";
            // line 212
            $context["field"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 213
                yield "      ";
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PluginFormcreatorCommon::showFontAwesomeDropdown", [($context["name"] ?? null), Twig\Extension\CoreExtension::merge(["value" =>                 // line 214
($context["value"] ?? null), "rand" =>                 // line 215
($context["rand"] ?? null), "width" => "100%"],                 // line 217
($context["options"] ?? null))]);
                // line 218
                yield "   ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 219
            yield "
   ";
            // line 220
            yield CoreExtension::callMacro($macros["fields"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), Twig\Extension\CoreExtension::merge(($context["options"] ?? null), ["id" => ((("dropdown_" . ($context["name"] ?? null)) . "_") . CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 220))])], 220, $context, $this->getSourceContext());
            yield "
";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 223
    public function macro_dropdownValidatorUser($__name__ = null, $__options__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 224
            yield "   ";
            $context["options"] = Twig\Extension\CoreExtension::merge(["rand" => Twig\Extension\CoreExtension::random($this->env->getCharset())], ($context["options"] ?? null));
            // line 225
            yield "
   ";
            // line 226
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 226)) {
                // line 227
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(($context["options"] ?? null), ["specific_tags" => ["disabled" => "disabled"]]);
                // line 228
                yield "   ";
            }
            // line 229
            yield "   ";
            if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 229), "isMandatoryField", [($context["name"] ?? null)], "method", false, false, false, 229)) {
                // line 230
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(["specific_tags" => ["required" => true]], ($context["options"] ?? null));
                // line 231
                yield "   ";
            }
            // line 232
            yield "
      ";
            // line 233
            $context["field"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 234
                yield "      ";
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PluginFormcreatorForm_Validator::dropdownValidatorUser", [($context["name"] ?? null), Twig\Extension\CoreExtension::merge(["value" =>                 // line 235
($context["value"] ?? null), "rand" =>                 // line 236
($context["rand"] ?? null), "width" => "100%"],                 // line 238
($context["options"] ?? null))]);
                // line 239
                yield "   ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 240
            yield "   ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["field"] ?? null), "html", null, true);
            yield "
";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 243
    public function macro_dropdownValidatorGroup($__name__ = null, $__options__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 244
            yield "   ";
            $context["options"] = Twig\Extension\CoreExtension::merge(["rand" => Twig\Extension\CoreExtension::random($this->env->getCharset())], ($context["options"] ?? null));
            // line 245
            yield "
   ";
            // line 246
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 246)) {
                // line 247
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(($context["options"] ?? null), ["specific_tags" => ["disabled" => "disabled"]]);
                // line 248
                yield "   ";
            }
            // line 249
            yield "   ";
            if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 249), "isMandatoryField", [($context["name"] ?? null)], "method", false, false, false, 249)) {
                // line 250
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(["specific_tags" => ["required" => true]], ($context["options"] ?? null));
                // line 251
                yield "   ";
            }
            // line 252
            yield "
   ";
            // line 253
            $context["field"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 254
                yield "      ";
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PluginFormcreatorForm_Validator::dropdownValidatorGroup", [($context["name"] ?? null), Twig\Extension\CoreExtension::merge(["value" =>                 // line 255
($context["value"] ?? null), "rand" =>                 // line 256
($context["rand"] ?? null), "width" => "100%"],                 // line 258
($context["options"] ?? null))]);
                // line 259
                yield "   ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 260
            yield "   ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["field"] ?? null), "html", null, true);
            yield "
";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 263
    public function macro_dropdownRequestType($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 264
            yield "   ";
            $macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/components/form/fields_macros.html.twig", 264)->unwrap();
            // line 265
            yield "   ";
            $context["options"] = Twig\Extension\CoreExtension::merge(["rand" => Twig\Extension\CoreExtension::random($this->env->getCharset())], ($context["options"] ?? null));
            // line 266
            yield "
   ";
            // line 267
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 267)) {
                // line 268
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(($context["options"] ?? null), ["specific_tags" => ["disabled" => "disabled"]]);
                // line 269
                yield "   ";
            }
            // line 270
            yield "   ";
            if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 270), "isMandatoryField", [($context["name"] ?? null)], "method", false, false, false, 270)) {
                // line 271
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(["specific_tags" => ["required" => true]], ($context["options"] ?? null));
                // line 272
                yield "   ";
            }
            // line 273
            yield "
   ";
            // line 274
            $context["field"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 275
                yield "      ";
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Ticket::dropdownType", [($context["name"] ?? null), Twig\Extension\CoreExtension::merge(["value" =>                 // line 276
($context["value"] ?? null), "rand" =>                 // line 277
($context["rand"] ?? null), "width" => "100%", "toadd" => [Twig\Extension\CoreExtension::constant("Dropdown::EMPTY_VALUE")]],                 // line 280
($context["options"] ?? null))]);
                // line 281
                yield "   ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 282
            yield "   ";
            yield CoreExtension::callMacro($macros["fields"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 282, $context, $this->getSourceContext());
            yield "
";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 285
    public function macro_timeField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 286
            yield "   ";
            $macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/components/form/fields_macros.html.twig", 286)->unwrap();
            // line 287
            yield "   ";
            $context["options"] = Twig\Extension\CoreExtension::merge(["rand" => Twig\Extension\CoreExtension::random($this->env->getCharset())], ($context["options"] ?? null));
            // line 288
            yield "
   ";
            // line 289
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 289)) {
                // line 290
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(($context["options"] ?? null), ["specific_tags" => ["disabled" => "disabled"]]);
                // line 291
                yield "   ";
            }
            // line 292
            yield "   ";
            if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 292), "isMandatoryField", [($context["name"] ?? null)], "method", false, false, false, 292)) {
                // line 293
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(["specific_tags" => ["required" => true]], ($context["options"] ?? null));
                // line 294
                yield "   ";
            }
            // line 295
            yield "
   ";
            // line 296
            $context["field"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 297
                yield "      ";
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::showTimeField", [($context["name"] ?? null), Twig\Extension\CoreExtension::merge(["value" =>                 // line 298
($context["value"] ?? null), "rand" =>                 // line 299
($context["rand"] ?? null), "width" => "100%"],                 // line 301
($context["options"] ?? null))]);
                // line 302
                yield "   ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 303
            yield "   ";
            yield CoreExtension::callMacro($macros["fields"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 303, $context, $this->getSourceContext());
            yield "
";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 306
    public function macro_dropdownUrgencyType($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 307
            yield "   ";
            $macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/components/form/fields_macros.html.twig", 307)->unwrap();
            // line 308
            yield "   ";
            $context["options"] = Twig\Extension\CoreExtension::merge(["rand" => Twig\Extension\CoreExtension::random($this->env->getCharset())], ($context["options"] ?? null));
            // line 309
            yield "
   ";
            // line 310
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 310)) {
                // line 311
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(($context["options"] ?? null), ["specific_tags" => ["disabled" => "disabled"]]);
                // line 312
                yield "   ";
            }
            // line 313
            yield "   ";
            if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 313), "isMandatoryField", [($context["name"] ?? null)], "method", false, false, false, 313)) {
                // line 314
                yield "      ";
                $context["options"] = Twig\Extension\CoreExtension::merge(["specific_tags" => ["required" => true]], ($context["options"] ?? null));
                // line 315
                yield "   ";
            }
            // line 316
            yield "
   ";
            // line 317
            $context["field"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 318
                yield "      ";
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Ticket::dropdownUrgency", [Twig\Extension\CoreExtension::merge(["name" =>                 // line 319
($context["name"] ?? null), "value" =>                 // line 320
($context["value"] ?? null), "rand" =>                 // line 321
($context["rand"] ?? null), "width" => "100%"],                 // line 323
($context["options"] ?? null))]);
                // line 324
                yield "   ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 325
            yield "   ";
            yield CoreExtension::callMacro($macros["fields"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 325, $context, $this->getSourceContext());
            yield "
";
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@formcreator/components/form/fields_macros.html.twig";
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
        return array (  976 => 325,  972 => 324,  970 => 323,  969 => 321,  968 => 320,  967 => 319,  965 => 318,  963 => 317,  960 => 316,  957 => 315,  954 => 314,  951 => 313,  948 => 312,  945 => 311,  943 => 310,  940 => 309,  937 => 308,  934 => 307,  919 => 306,  910 => 303,  906 => 302,  904 => 301,  903 => 299,  902 => 298,  900 => 297,  898 => 296,  895 => 295,  892 => 294,  889 => 293,  886 => 292,  883 => 291,  880 => 290,  878 => 289,  875 => 288,  872 => 287,  869 => 286,  854 => 285,  845 => 282,  841 => 281,  839 => 280,  838 => 277,  837 => 276,  835 => 275,  833 => 274,  830 => 273,  827 => 272,  824 => 271,  821 => 270,  818 => 269,  815 => 268,  813 => 267,  810 => 266,  807 => 265,  804 => 264,  789 => 263,  780 => 260,  776 => 259,  774 => 258,  773 => 256,  772 => 255,  770 => 254,  768 => 253,  765 => 252,  762 => 251,  759 => 250,  756 => 249,  753 => 248,  750 => 247,  748 => 246,  745 => 245,  742 => 244,  729 => 243,  720 => 240,  716 => 239,  714 => 238,  713 => 236,  712 => 235,  710 => 234,  708 => 233,  705 => 232,  702 => 231,  699 => 230,  696 => 229,  693 => 228,  690 => 227,  688 => 226,  685 => 225,  682 => 224,  669 => 223,  661 => 220,  658 => 219,  654 => 218,  652 => 217,  651 => 215,  650 => 214,  648 => 213,  646 => 212,  643 => 211,  640 => 210,  637 => 209,  634 => 208,  631 => 207,  628 => 206,  626 => 205,  623 => 204,  620 => 203,  617 => 202,  602 => 201,  594 => 198,  591 => 197,  587 => 196,  585 => 195,  584 => 193,  583 => 192,  581 => 191,  579 => 190,  576 => 189,  573 => 188,  570 => 187,  567 => 186,  564 => 185,  561 => 184,  559 => 183,  556 => 182,  553 => 181,  550 => 180,  535 => 179,  526 => 176,  520 => 174,  516 => 173,  512 => 172,  506 => 171,  500 => 168,  496 => 167,  492 => 166,  486 => 165,  482 => 163,  480 => 162,  477 => 161,  474 => 160,  471 => 159,  468 => 158,  465 => 157,  449 => 156,  441 => 153,  438 => 152,  434 => 151,  432 => 150,  431 => 148,  430 => 147,  428 => 146,  426 => 145,  423 => 144,  420 => 143,  417 => 142,  414 => 141,  411 => 140,  408 => 139,  406 => 138,  403 => 137,  401 => 136,  398 => 135,  395 => 134,  380 => 133,  372 => 130,  369 => 129,  365 => 128,  363 => 127,  362 => 125,  361 => 124,  359 => 123,  357 => 122,  354 => 121,  351 => 120,  348 => 119,  345 => 118,  342 => 117,  339 => 116,  337 => 115,  334 => 114,  332 => 113,  329 => 112,  326 => 111,  311 => 110,  303 => 107,  300 => 106,  296 => 105,  294 => 104,  293 => 102,  292 => 101,  290 => 100,  288 => 99,  285 => 98,  282 => 97,  279 => 96,  276 => 95,  273 => 94,  270 => 93,  268 => 92,  265 => 91,  263 => 90,  260 => 89,  257 => 88,  242 => 87,  234 => 84,  231 => 83,  227 => 82,  225 => 81,  224 => 79,  223 => 78,  221 => 77,  219 => 76,  216 => 75,  213 => 74,  210 => 73,  207 => 72,  204 => 71,  201 => 70,  199 => 69,  196 => 68,  194 => 67,  191 => 66,  188 => 65,  173 => 64,  163 => 60,  160 => 59,  156 => 58,  154 => 57,  153 => 55,  152 => 54,  150 => 53,  148 => 52,  145 => 51,  142 => 50,  139 => 49,  137 => 48,  134 => 47,  131 => 46,  128 => 45,  125 => 44,  122 => 43,  119 => 42,  116 => 41,  110 => 38,  107 => 37,  105 => 36,  103 => 35,  100 => 34,  97 => 33,  82 => 32,  76 => 305,  73 => 284,  70 => 262,  67 => 242,  64 => 222,  61 => 200,  58 => 178,  55 => 155,  52 => 132,  49 => 109,  46 => 86,  43 => 63,  40 => 31,  38 => 30,);
    }

    public function getSourceContext()
    {
        return new Source("", "@formcreator/components/form/fields_macros.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\plugins\\formcreator\\templates\\components\\form\\fields_macros.html.twig");
    }
}
