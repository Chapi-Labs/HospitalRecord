<?php

namespace ConsultaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ConsultaBundle\Form\Type\ConsultaType as ConsultaForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("has_role('ROLE_USER')")
 */
class ConsultaController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ConsultaBundle:Default:index.html.twig', array('name' => $name));
    }

    public function consultarPacienteAction(Request $request)
    {
        $repositoryPaciente = $this->getDoctrine()->getRepository('AppBundle:Paciente');
        $cantidadPacientes = $repositoryPaciente
                ->createQueryBuilder('p')
                ->select('COUNT(p.id)')
                ->leftJoin('p.ingreso', 'ingreso')
                ->getQuery()
                ->getSingleScalarResult();

        $formConsultas = $this->createForm(
            new ConsultaForm()
        );

        $formConsultas->handleRequest($request);

        if (!$formConsultas->isValid()) {
            return $this->render(
                'ConsultaBundle:Consulta:consultaPaciente.html.twig',
                [
                    'form' => $formConsultas->createView(),
                    'pacientes' => null,
                    'contPacientes' => $cantidadPacientes,
                ]
            );
        }

        $dataForm = $formConsultas->getData();
        $tipoConsulta = 0;

        if (isset($dataForm['consulta_dpi_nombre_apellidos'])) {
            $tipoConsulta = 1;
        } elseif (isset($dataForm['consulta_fecha_ingreso'])) {
            $tipoConsulta = 2;
        } elseif (isset($dataForm['consulta_procedimiento_realizado'])) {
            $tipoConsulta = 3;
        }

        $pacientes = [];

        if ($tipoConsulta == 1) {
            $pacientes[] = $dataForm['consulta_dpi_nombre_apellidos'];
        } elseif ($tipoConsulta == 2) {
            $fecha = $dataForm['consulta_fecha_ingreso'];
            $fechaInicio = $fecha->format('Y-m-d');
            $fecha = $fecha->modify('+1 day');
            $fechaFin = $fecha->format('Y-m-d');

            $pacientes = $repositoryPaciente
                ->createQueryBuilder('p')
                ->leftJoin('p.ingreso', 'ingreso')
                ->where('ingreso.fechaIngreso >= :fechaInicio')
                ->andWhere('ingreso.fechaIngreso < :fechaFin')
                ->setParameters([
                    'fechaInicio' => $fechaInicio,
                    'fechaFin' => $fechaFin,
                    ])
                ->getQuery()
                ->getResult();
        } elseif ($tipoConsulta == 3) {
            $diagnostico = $dataForm['consulta_procedimiento_realizado'];

            $qb = $repositoryPaciente->createQueryBuilder('p');
            $pacientes = $qb
                ->leftJoin('p.ingreso', 'ingreso')
                ->where('ingreso.diagnosticoCie10 = :diagnostico')
                ->setParameter('diagnostico', $diagnostico)
                ->getQuery()
                ->getResult();
        }

        return $this->render(
            'ConsultaBundle:Consulta:consultaPaciente.html.twig',
            [
                'form' => $formConsultas->createView(),
                'pacientes' => $pacientes,
                'contPacientes' => $cantidadPacientes,
            ]
        );
    }
}
