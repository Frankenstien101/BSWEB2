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

/* @formcreator/components/form/form_taglist.html.twig */
class __TwigTemplate_65ed1962b6d0a7e1cae2d357739919b4a440d0a47b44dab3424c18c2379227ee extends Template
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
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "@formcreator/components/form/form_taglist.html.twig", 31)->unwrap();
        // line 32
        yield "
<div class=\"card-body d-flex flex-wrap\">
    <div class=\"col-12 col-xxl-";
        // line 34
        yield ((($context["item_has_pictures"] ?? null)) ? ("9") : ("12"));
        yield " flex-column\">
        <div class=\"d-flex flex-row flex-wrap flex-xl-nowrap\">
        <div class=\"row flex-row align-items-start flex-grow-1\">
            <div class=\"row flex-row\">
                <table class=\"table\">
                    <tr><th colspan=\"5\">";
        // line 39
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("List of available tags"), "html", null, true);
        yield "</th></tr>
                    <tr>
                        <th colspan=\"2\">";
        // line 41
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_n("Question", "Questions", 1, "formcreator"), "html", null, true);
        yield "</th>
                        <th>";
        // line 42
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Title"), "html", null, true);
        yield "</th>
                        <th>";
        // line 43
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_n("Answer", "Answers", 1, "formcreator"), "html", null, true);
        yield "</th>
                        <th>";
        // line 44
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_n("Section", "Sections", 1, "formcreator"), "html", null, true);
        yield "</th>
                    </tr>
                    <tr>
                        <td colspan=\"2\"><strong>";
        // line 47
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Full form", "formcreator"), "html", null, true);
        yield "</strong></td>
                        <td>-</td>
                        <td><strong>##FULLFORM##</strong></td>
                        <td>-</td>
                    </tr>
                     ";
        // line 52
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["extra_tags"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
            // line 53
            yield "                        <tr>
                            <td colspan=\"2\"><strong>";
            // line 54
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "question", [], "any", false, false, false, 54), "html", null, true);
            yield "</strong></td>
                            <td>";
            // line 55
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "title", [], "any", false, false, false, 55), "html", null, true);
            yield "</td>
                            <td><strong>";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "answer", [], "any", false, false, false, 56), "html", null, true);
            yield "</strong></td>
                            <td>";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "section", [], "any", false, false, false, 57), "html", null, true);
            yield "</td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 60
        yield "                    ";
        $context["sections"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("PluginFormcreatorQuestion::getQuestionsFromFormBySection", [($context["item"] ?? null)]);
        // line 61
        yield "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["sections"] ?? null));
        foreach ($context['_seq'] as $context["sectionName"] => $context["questions"]) {
            // line 62
            yield "                        ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["questions"]);
            foreach ($context['_seq'] as $context["questionId"] => $context["questionName"]) {
                // line 63
                yield "                            <tr>
                                <td colspan=\"2\">";
                // line 64
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["questionName"], "html", null, true);
                yield "</td>
                                <td>##question_";
                // line 65
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["questionId"], "html", null, true);
                yield "##</td>
                                <td>##answer_";
                // line 66
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["questionId"], "html", null, true);
                yield "##</td>
                                <td>";
                // line 67
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["sectionName"], "html", null, true);
                yield "</td>
                            </tr>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['questionId'], $context['questionName'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 70
            yield "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['sectionName'], $context['questions'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 71
        yield "                </table>
            </div> ";
        // line 73
        yield "        </div> ";
        // line 74
        yield "        </div> ";
        // line 75
        yield "    </div>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@formcreator/components/form/form_taglist.html.twig";
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
        return array (  164 => 75,  162 => 74,  160 => 73,  157 => 71,  151 => 70,  142 => 67,  138 => 66,  134 => 65,  130 => 64,  127 => 63,  122 => 62,  117 => 61,  114 => 60,  105 => 57,  101 => 56,  97 => 55,  93 => 54,  90 => 53,  86 => 52,  78 => 47,  72 => 44,  68 => 43,  64 => 42,  60 => 41,  55 => 39,  47 => 34,  43 => 32,  41 => 31,  38 => 30,);
    }

    public function getSourceContext()
    {
        return new Source("", "@formcreator/components/form/form_taglist.html.twig", "C:\\Users\\Administrator\\Documents\\BSPI_SERVER\\DEPLOYMENT\\glpi\\plugins\\formcreator\\templates\\components\\form\\form_taglist.html.twig");
    }
}
